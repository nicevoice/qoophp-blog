<?php
/**
 * @author: Rogee<rogeeyang@gmail.com>
 */

namespace Models;


use Common\ModelCommon;
use Phalcon\Validation;

class Category extends ModelCommon
{

    public function rules()
    {
        return array(
            array('name, slug', 'Uniqueness')
        );
    }

    public function validation()
    {
        return parent::validation();
    }

    public function relations()
    {
        return array(
            'id' => array(self::HAS_MANY, '\Models\Article', 'category_id', array('alias' => 'article_model')),
        );
    }

    /**
     * 获取分类下文章数量
     * @return int
     */
    public function getArticleCount()
    {
        return count($this->article_model);
    }

    /**
     * 根据别名获取Category_id
     * @param $slug
     * @return Model
     */
    public static function getIdBySlug($slug)
    {
        $criteria = array(
            'conditions' =>'slug = :slug:',
            'bind' => array("slug"=>$slug)
        );
        return self::findFirst($criteria);
    }

    public static function inc($id)
    {
        $model = self::findFirstById($id);
        $model->article_count += 1;
        $model->save();
    }

    public static function dec($id)
    {
        $model = self::findFirstById($id);
        $model->article_count -= 1;
        if ($model->article_count < 0) {
            $model->article_count = 0;
        }
        $model->save();
    }

    public static function getCagegoryId($name)
    {
        $model = self::findFirst(array('name = ?0', array($name)));
        if($model)
            return $model->id;
        $model = new Category();
        $model->name = $name;
        $model->slug = '';
        $model->article_count = 0;
        $model->save();
        return $model->id;
    }
} 