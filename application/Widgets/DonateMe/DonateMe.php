<?php
/**
 * @author: Rogee<rogeeyang@gmail.com>
 */

namespace Widgets\DonateMe;


use Common\WidgetComponent;

class DonateMe extends WidgetComponent
{
    public function initialize($params)
    {
        $this->render('donate',array());
    }
}