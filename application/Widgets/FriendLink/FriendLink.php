<?php
/**
 * @author: Rogee<rogeeyang@gmail.com>
 */
namespace Widgets\FriendLink;


use Common\WidgetComponent;

class FriendLink extends WidgetComponent
{
    public function initialize($params)
    {
        $this->render('friend_link',array());
    }
}