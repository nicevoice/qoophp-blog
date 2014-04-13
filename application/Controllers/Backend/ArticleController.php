<?php
namespace Controllers;

use Common\BackendControllerBase;
use Form\ArticleForm;
use Models\Article;
use Models\ArticleTag;
use Models\Category;

class ArticleController extends BackendControllerBase
{
    public function initialize ()
    {
        parent::initialize();
    }

    public function indexAction ()
    {
        \Phalcon\Tag::prependTitle( "文章列表 - " );

        $data = Article::find(array('order'=>'create_date desc'));
        $pages = $this->getPagination($data, intval($_GET['page']), 30);

        $this->setVar('pages', $pages);

    }

    public function createAction ()
    {
        $this->setTitle('创建新文章');

        $form = new ArticleForm();
        if( $this->request->isPost() ){
            $model = new Article();
            $form->bind($_POST, $model);

            $model->author = $this->auth->getId();
            $tag = $model->getTagId($this->request->getPost('tag', 'string'));
            $model->initDescriptionBeforeSave();

            if (!$model->save()) {
                $this->flash->error($model->getErrorMessage());
                return $this->forward('article/create');
            }

            ArticleTag::saveTag($model->id, $tag);
            Category::inc($model->category_id);
            $this->flash->success('保存成功！');
            $this->redirect('article/edit/'.$model->id);
        }
        $this->view->setVar('form', $form);
        $this->view->pick('article/form');
    }

    public function editAction()
    {
        $this->setTitle('编辑文章');

        $id = $this->dispatcher->getParam('id');

        $model = Article::findFirstById($id);
        if ($model == false) {
            $this->redirect('article/index');
        }
        $old_category = $model->category_id;
        $form = new ArticleForm($model);

        if( $this->request->isPost() ){
            $form->bind($_POST, $model);
            $tag = $model->getTagId($this->request->getPost('tag', 'string'));
            $model->initDescriptionBeforeSave();

            if (!$model->save()) {
                $this->flash->error($model->getErrorMessage());
                return $this->forward('article/edit/'.$id);
            }

            ArticleTag::saveTag($model->id, $tag);
            if($old_category != $model->category_id)
            {
                Category::inc($model->category_id);
                Category::dec($old_category);
            }
            $this->flash->success('保存成功！');
            $this->redirect('article/edit/'.$model->id);
        }
        $model->tag = $model->getArticleStringRawTags();

        $this->setVar('form', $form);
        $this->view->pick('article/form');
    }

    public function deleteAction()
    {
        $id = $this->dispatcher->getParam('id');
        $model = Article::findFirstById($id);
            $model->trash();
        Category::dec($model->category_id);
        $this->flash->success('删除成功！');
        $this->redirect('article/index');
    }

    public function revertAction()
    {
        $id = $this->dispatcher->getParam('id');
        $model = Article::findFirst($id);
        $model->revert();
        Category::inc($model->category_id);
        $this->flash->success('恢复成功！');
        $this->redirect('article/index');
    }
}

