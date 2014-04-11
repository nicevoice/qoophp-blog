<?php
/**
 * @author: Rogee<rogeeyang@gmail.com>
 */
namespace Widgets\Ad;


use Common\WidgetComponent;

class Ad extends WidgetComponent
{
    public function initialize($params)
    {
        $this->render('ad',array());
    }
}