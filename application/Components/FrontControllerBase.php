<?php
/**
 * @author: Rogee<rogeeyang@gmail.com>
 */

namespace Common;

class FrontControllerBase extends ControllerBase{
    public function initialize()
    {
        \Phalcon\Tag::setTitle('QooPHP');
    }

    public function beforeExecuteRoute($dispatcher)
    {
//        $module = $dispatcher->getModuleName();
//        $controller = $dispatcher->getControllerName();
//        $action = $dispatcher->getActionName();
//
//        var_dump($module, $controller, $action);
    }
}