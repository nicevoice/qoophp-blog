<?php
/**
 * @author: Rogee<rogeeyang@gmail.com>
 */

namespace Models;


use Common\ModelCommon;
use Phalcon\Validation;

class ArticleTag extends ModelCommon
{

    public function validation()
    {
        return parent::validation();
    }

    public function relations()
    {
        return array(
            'tag_id' => array(self::BELONGS_TO, '\Models\Tag', 'id', array('alias' => 'tag'))
        );
    }

    /**
     * 保存数组TAG到指定ARTICLE_ID中
     * @param $article_id
     * @param $tags
     */
    public static function saveTag($article_id, $tags)
    {
        foreach ($tags as $tag_id) {
            $criteria = array(
                "conditions" => "article_id = ?0 and tag_id =?1",
                "bind"       => array($article_id, $tag_id)
            );
            $model = ArticleTag::findFirst($criteria);
            if ($model->id > 0) {
                continue;
            }

            $model = new ArticleTag();
            $model->article_id = $article_id;
            $model->tag_id = $tag_id;
            $model->save();
        }
    }

    /**
     * 获取含有标签的文章列表
     * @param $id
     * @return array
     */
    public static function getArticleIdListByTagId($id)
    {
        $data = self::find('tag_id = '.$id);
        $id_arr = array();
        foreach($data as $item){
            $id_arr[] = $item->article_id;
        }
        return $id_arr;
    }


} 