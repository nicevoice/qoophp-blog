<?php
/**
 * @author: Rogee<rogeeyang@gmail.com>
 */

namespace Models;


use Common\ModelCommon;
use Phalcon\Validation;

class Tag extends ModelCommon
{

    public function rules()
    {
        return array(
            array('name', 'Uniqueness')
        );
    }

    public function validation()
    {
        return parent::validation();
    }

    public function relations()
    {
        return array(
            'id' => array(self::HAS_MANY, 'ArticleTag', 'tag_id')
        );
    }

    /**
     * 保存数组中的Tag name 如果存在Hot+1
     * @param $tag
     * @return array
     */
    public static function saveTags($tag)
    {
        $id = array();
        foreach ($tag as $tag_name) {
            $tag_name = trim($tag_name);
            $model = self::findFirstByName($tag_name);
            if ($model == false) {
                $model = new Tag();
                $model->hot = 1;
                $model->name = $tag_name;
            } else {
                $model->hot += 1;
            }
            $model->save();
            $id[] = $model->id;
        }

        return $id;
    }

    public static function getIdByName($name)
    {
        return self::findFirstByName($name)->id;
    }

    public function delTagById($id)
    {
        $id = intval($id);
        $model = self::findFirstById($id);
        if ($model != false) {
            if ($model->hot == 0) {
                $model->delete();
            } else {
                $model->hot -= 1;
                $model->save();
            }
        }
    }

    public function deleteTagByName($name)
    {
        $name = trim($name);
        $model = self::findFirstByName($name);
        if ($model != false) {
            if ($model->hot == 0) {
                $model->delete();
            } else {
                $model->hot -= 1;
                $model->save();
            }
        }
    }

} 