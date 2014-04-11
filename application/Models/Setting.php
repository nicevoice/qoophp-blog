<?php
/**
 * @author: Rogee<rogeeyang@gmail.com>
 */

namespace Models;


class Setting extends \Common\ModelCommon{


    /**
     * save all settings from $setting
     * @param $setting array('123'=>'asdf')
     * @return bool
     */
    public static function saveSettings($setting)
    {
        foreach($setting as $key=>$value){
            $model = self::findFirstByAlias($key);
            if( !$model ){
                $model = new Setting();
                $model->alias = $key;
            }
            $model->config = $value;
            $model->save();
        }
        return true;
    }

    /**
     * 获取一个数组格式的所有数据列表
     * @return array
     */
    public static function getSettings()
    {
        $data = self::find();
        $setting = array();
        foreach($data as $item){
            $setting[$item->alias] = $item->config;
        }

        return $setting;
    }
} 