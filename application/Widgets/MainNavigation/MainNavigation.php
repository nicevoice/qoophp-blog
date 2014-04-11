<?php
/**
 * @author: Rogee<rogeeyang@gmail.com>
 */
namespace Widgets\MainNavigation;


use Common\WidgetComponent;

class MainNavigation extends WidgetComponent
{
    public function initialize($params)
    {
        $this->render('nav',array('items'=>$this->_getItems()));
    }

    private function _getItems()
    {
        $items = array(
            '微点滴'=> $this->url->get('weixin'),
            '书签'  =>  $this->url->get('bookmark'),
            '标签墙' => $this->url->get('tag'),
            '优惠码' => $this->url->get('coupon'),
            '关于我' => $this->url->get('about'),
        );

        $end_items = array();
        foreach($items as $key=>$item){
            $end_items[] = array(
                'name' => $key,
                'url' => $item
            );
        }
        return $end_items;
    }
}