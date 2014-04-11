<?php
/**
 * @author: Rogee<rogeeyang@gmail.com>
 */
namespace Controllers;

use Common\FrontControllerBase;
use Models\WeiDianDi;
use Models\Weixin;
use Phalcon\Mvc\View;

class WeixinController extends FrontControllerBase
{
    public function indexAction (){
        $this->setTitle("微点滴");
        $page = intval($this->dispatcher->getParam('page'));
        if($page == 0){
            $page = 1;
        }

        $data = WeiDianDi::find(array('order'=>'create_date desc'));
        $items = $this->getPagination($data, $page, 30);
        $this->setVar('items', $items->items);
    }

    public function receiveAction()
    {
        $this->view->setRenderLevel(View::LEVEL_BEFORE_TEMPLATE);
        $this->view->setTemplateBefore('WeiXin_Tpl');

        $weixin = new Weixin();
        $object = $weixin->getObject();

        $this->setVar('obj',$object);
        $this->view->pick('weixin/tpl/'.$object->getType());
    }
}