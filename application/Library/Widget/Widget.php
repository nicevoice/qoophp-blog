<?php
/**
 * @author: Rogee<rogeeyang@gmail.com>
 */

namespace Library\Widget;

class Widget {
    public function get($name, $params=array())
    {
        $namespace = '\Widgets\\'.$name.'\\'.$name;

        $model = new $namespace();
        return $model->initialize($params);
    }
} 