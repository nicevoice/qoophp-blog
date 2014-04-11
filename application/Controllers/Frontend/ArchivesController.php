<?php
/**
 * @author: Rogee<rogeeyang@gmail.com>
 */
namespace Controllers;

use Common\FrontControllerBase;
use Models\Article;
use Models\Tag;

class ArchivesController extends FrontControllerBase
{
    public function initialize()
    {
        parent::initialize();
    }

    public function indexAction()
    {
        $this->view->setTemplateBefore(array('comments','columns'));

        $id = $this->dispatcher->getParam('id');
        if (empty($id)) {
            return $this->forward('error/page404');
        }
        $model = Article::findFirstById($id);

        if (false == $model) {
            return $this->forward('error/page404');
        }

        $model->incViewCount();
        $this->setTitle($model->name);
        $this->setVar('data', $model);
    }

    public function tagAction()
    {
        $this->view->setTemplateBefore('comments');

        $this->setTitle('标签墙');
        $tag = Tag::find();
        $this->setVar('tag', $tag);
    }

    public function tagNameAction()
    {
        $this->view->setTemplateBefore('columns');

        $name = $this->dispatcher->getParam('tag');
        $page = intval($this->dispatcher->getParam('page'));

        $this->setTitle($name . '标签文章');

        $data = Article::getTagArticle($name);

        if (count($data->toArray()) == 0) {
            return $this->forward('error/emptyInfo');
        }
        $page_data = $this->getPagination($data, $page);
        $this->setVar('pages', $page_data);
        $this->setVar('tag_name', $name);
    }
} 