<?php
/**
 * @author: Rogee<rogeeyang@gmail.com>
 */
namespace Widgets\ToolNavigation;


use Common\WidgetComponent;

class ToolNavigation extends WidgetComponent
{
    public function initialize($params)
    {
        $this->render('category',array('items'=>$this->_getItems()));
    }

    private function _getItems()
    {
        $items = array(
            array(
                'name' => '淘宝店',
                'url'  => 'http://qoofan.taobao.com'
            )
        );
        return $items;
    }
}