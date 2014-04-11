<?php
/**
 * @author: Rogee<rogeeyang@gmail.com>
 */

namespace Controllers;


use Common\FrontControllerBase;
use Models\Bookmark;
use Models\Category;
use Phalcon\Mvc\View;

class BookmarkController extends FrontControllerBase
{
    public function insertAction()
    {
        $this->view->setRenderLevel(View::LEVEL_ACTION_VIEW);
        $this->setVar('catInfo', Category::find());

        if($this->request->isPost())
        {
            $model = new Bookmark();
            $ret = $model->save($_POST, array('name','link','category_id','memo'));
            if($ret){
                echo '<script>self.close();</script>';
                exit;
            }else{
                foreach($model->getMessages() as $msg){
                    echo $msg->getMessage();echo "<br />";
                }
            }
        }
    }

    public function indexAction()
    {
        $this->setTitle('书签');

        $page = $this->dispatcher->getParam('page');
        $article = Bookmark::getList();
        $page_info = $this->getPagination($article, $page, 30);

        $this->setVar('pages', $page_info);
    }

    public function deleteAction()
    {
        $id = $this->request->get('id', 'int');
        Bookmark::findFirstById($id)->delete();
        $this->json();
    }
} 