<?php
/**
 * @author: Rogee<rogeeyang@gmail.com>
 */

namespace Library\Setting;


use Phalcon\Mvc\User\Component;

class Setting extends Component
{
    private static $_setting = array();

    public function get($name)
    {

        if (empty(self::$_setting)) {
            self::$_setting = \Models\Setting::getSettings();
        }
        return self::$_setting[$name];
    }

    public function isDebug()
    {
        if(defined("DEBUG_MODE") && DEBUG_MODE)
            return true;
        return false;
    }

    public function debugFile($file)
    {
        if($this->isDebug())
            return $file.'_dev';
        return $file;
    }

}