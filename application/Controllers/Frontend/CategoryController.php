<?php
/**
 * @author: Rogee<rogeeyang@gmail.com>
 */

namespace Controllers;


use Common\FrontControllerBase;
use Models\Article;
use Models\Category;

class CategoryController extends FrontControllerBase
{
    public function indexAction()
    {
        $this->setTitle('文章分类');
        $items = Category::find();
        if(count($items->toArray()) == 0){
            return $this->forward('error/emptyInfo');
        }
        $this->setVar('items', $items);
    }

    public function articleAction()
    {
        $this->view->setTemplateBefore('columns');
        $slug = $this->dispatcher->getParam('slug');
        $cat = Category::getIdBySlug($slug);

        $this->setTitle($cat->name);

        $article_list = Article::getCategoryList($cat->id);
        if(count($article_list->toArray()) == 0){
            return $this->forward('error/emptyInfo');
        }
        $pages = $this->getPagination($article_list, intval($this->dispatcher->getParam('page')));

        $this->setVar('pages', $pages);
        $this->setVar('cat_name', $cat->name);
        $this->setVar('slug', $slug);

    }
} 