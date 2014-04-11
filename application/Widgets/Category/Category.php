<?php
/**
 * @author: Rogee<rogeeyang@gmail.com>
 */
namespace Widgets\Category;


use Common\WidgetComponent;

class Category extends WidgetComponent
{
    public function initialize($params)
    {
        $items = \Models\Category::find();

        $this->render('category',array('items'=>$items));
    }
}