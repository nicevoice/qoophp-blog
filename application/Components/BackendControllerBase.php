<?php
/**
 * @author: Rogee<rogeeyang@gmail.com>
 */

namespace Common;

class BackendControllerBase extends ControllerBase{
    public function initialize()
    {
        \Phalcon\Tag::setTitle('后台');
    }

    public function beforeExecuteRoute($dispatcher)
    {
        //检查用户是不是登陆
        $this->checkIsGuest($dispatcher);
    }
}