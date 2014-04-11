<?php
/**
 * @author: Rogee<rogeeyang@gmail.com>
 */
namespace Widgets\WeiBo;


use Common\WidgetComponent;

class WeiBo extends WidgetComponent
{
    public function initialize($params)
    {
        $this->render('weibo',array());
    }
}