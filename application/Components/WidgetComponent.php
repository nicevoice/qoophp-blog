<?php
/**
 * @author: Rogee<rogeeyang@gmail.com>
 */

namespace Common;


use Phalcon\Mvc\User\Component;
use Phalcon\Mvc\View\Engine\Volt;

abstract class WidgetComponent extends Component
{
    abstract public function initialize($params);

    final public function render($template, $params, $is_return = false)
    {
        $view = $this->widget_view;
        $ref = new \ReflectionClass($this);

        $model_class_name = substr($ref->getName(), strlen($ref->getNamespaceName()) + 1);
        $base_path = WIDGET_PATH .'/'. $model_class_name .'/View/';
        $this->getDI()->getShared('widget_view')->setViewsDir($base_path);

        $content = $view->render($template, $params);

        if($is_return)
            return $content;
        else
            echo $content;
    }
}