<?php
namespace Controllers;

use Common\BackendControllerBase;
use Form\CategoryForm;
use Models\Category;

class CategoryController extends BackendControllerBase
{

    public function indexAction()
    {
        $this->setTitle('文章分类 - ');
        $model_list = Category::find();
        $this->view->setVar('items', $model_list);
    }

    public function saveAction()
    {
        if ($this->request->isPost()) {
            $id = $this->dispatcher->getParam('id', 'int');
            $model = Category::findFirstById($id);
            if ($model == false) {
                $model = new Category();
            }

            $model->name = $this->request->getPost('name', 'string');
            $model->slug = strtolower($this->request->getPost('slug', 'string'));

            if (!isset($model->id)) {
                $model->article_count = $this->request->getPost('article_count', null, 0);
            }

            if (!$model->save()) {
                $this->flash->error($model->getErrorMessage());
            } else {
                $this->flash->success('保存成功！');
            }
        }
        $this->redirect('category/index');
    }

    public function createAction()
    {
        $url = $this->url->get('category/save');
        $form = new CategoryForm();
        $this->view->setVars(array(
            'url' => $url,
            'form' => $form
        ));
        $this->view->pick('category/form');
    }

    public function editAction()
    {
        $id = $this->dispatcher->getParam('id');
        $url = $this->url->get('category/save/' . $id);

        $model = Category::findFirstById($id);
        if ($model === false) {
            $this->redirect('category/index');
        }

        $form = new CategoryForm($model);

        $this->view->setVars(array(
            'url' => $url,
            'form' => $form
        ));
        $this->view->pick('category/form');
    }

    public function deleteAction()
    {
        $id = $this->dispatcher->getParam('id', 'int');
        $model = Category::findFirstById($id);
        if ($model->article_count > 0) {
            $this->flash->error('删除失败，分类下还有文章存在！');
        } else {
            $model->delete();
            $this->flash->success('删除成功！');
        }

        return $this->response->redirect('category/index');
    }
}

