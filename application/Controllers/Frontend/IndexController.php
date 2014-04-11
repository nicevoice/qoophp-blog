<?php
namespace Controllers;

use Common\FrontControllerBase;
use Models\Article;
use Phalcon\Mvc\View;

class IndexController extends FrontControllerBase
{

    public function indexAction()
    {
        $this->setTitle('首页');
        $this->view->setTemplateBefore('columns');

        $page = $this->dispatcher->getParam('page', "int", 1);
        $article = Article::getList();
        $page_info = $this->getPagination($article, $page);

        $this->setVar('pages', $page_info);
    }
}

