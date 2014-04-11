<?php
/**
 * @author: Rogee<rogeeyang@gmail.com>
 */

namespace Models;


use Common\ModelCommon;
use Library\CloudSearch\CloudsearchDoc;
use Phalcon\Validation;

class Article extends ModelCommon
{
    const STATUS_DISABLE = 0;
    const STATUS_ENABLE = 1;

    public $tag = '';

    public function rules()
    {
        return array( //            array('name, slug', 'Uniqueness')
        );
    }

    public function relations()
    {
        return array(
            'id' => array(self::HAS_MANY, '\Models\ArticleTag', 'article_id', array('alias' => 'article_tag_alias')),
            'category_id' => array(self::BELONGS_TO, '\Models\Category', 'id', array('alias' => 'category_alias')),
        );
    }

    public function validation()
    {
        if(is_null($this->view_count))
            $this->view_count = 0;
        if(is_null($this->status))
            $this->status = self::STATUS_ENABLE;

        return parent::validation();
    }

    public static function getList()
    {
        $model = Article::find(array(
            'conditions' => 'status = ?0',
            'bind' => array(self::STATUS_ENABLE),
            'order' => 'create_date desc'
        ));
        return $model;
    }

    /**
     * 获取含有标签的文章列表
     * @param $name
     * @return \Phalcon\Mvc\Model\ResultsetInterface
     */
    public static function getTagArticle($name)
    {
        $tag_id = Tag::getIdByName($name);
        $article_id_list = ArticleTag::getArticleIdListByTagId($tag_id);
        $in = implode(',', $article_id_list);
        $criteria = array(
            'conditions' => "id in ({$in})",
            'order' => 'create_date desc',
        );

        return self::find($criteria);
    }

    /**
     * 获取指定分类下的文章列表
     * @param $id
     * @return \Phalcon\Mvc\Model\ResultsetInterface
     */
    public static function getCategoryList($id)
    {
        $criteria = array(
            'conditions' => 'category_id = ?0',
            'bind' => array($id),
            'order' => 'create_date desc'
        );
        $article_list = self::find($criteria);
        return $article_list;
    }

    /**
     * 如果为空则创建Desciption.
     */
    public function initDescriptionBeforeSave()
    {
        $more_tag_pos = mb_strpos($this->content, '<!--more-->', null, 'utf-8');
        if ($more_tag_pos === false ) {
            $more_tag_pos = mb_strpos($this->content, '<hr class="more">', null, 'utf-8');
        }

        if ($more_tag_pos === false ) {
            $this->description = $this->content;
            return;
        }
        $this->description = mb_substr($this->content, 0, $more_tag_pos, 'utf-8');
    }

    public function getTagId($tag)
    {
        $tag = explode(',', $tag);
        $tag_id = Tag::saveTags($tag);
        return $tag_id;
    }

    /**
     * 获取文章字符类型的TAG列表
     * @return string
     */
    public function getArticleStringTags()
    {
        $tags = $this->article_tag_alias;
        $tag = array();
        if (!count($tags)) {
            return '没有打标签';
        }

        foreach ($tags as $tag_model) {
            $tag_link = $this->getDI()->getUrl()->get(array(
                'for' => 'tag-page',
                'tag' => $tag_model->tag->name,
                'page' => 0
            ));
            $tag[] = '<a href="' . $tag_link . '">' . $tag_model->tag->name . '</a>';
        }
        return implode(',', $tag);
    }

    public function addSearch()
    {
        $cmd = "ADD";
        $data_org = $this->_getSearchBaseInfo();
        $data[] = array('fields'=>$data_org, 'cmd'=>$cmd);
        $app_name = $this->_di('config')->search->app_name;
        $app = new CloudsearchDoc($app_name, $this->_di('search'));
        $ret = $app->add($data, 'main');
        return $ret;
    }

    public function updateSearch()
    {
        $app_name = $this->_di('config')->search->app_name;
        $cmd = "UPDATE";
        $data_org = $this->_getSearchBaseInfo();
        $data[] = array('fields'=>$data_org, 'cmd'=>$cmd);
        $app = new CloudsearchDoc($app_name, $this->_di('search'));
        $ret = $app->update($data, 'main');
        return $ret;
    }

    private function _getSearchBaseInfo(){
        $data_fields = array(
            'id' => $this->id,
            'url' => $this->_di('setting')->get('site_url').'/archives/'.$this->id,
            'author' => 'Rogee',
            'source' => 'QooPHP',
            'title' => $this->name,
            'display_text' => $this->description,
            'body' => $this->content,
            'cat_id' => intval($this->category_id),
            'hit_num'=> intval($this->view_count),
            'update_timestamp' => $this->update_date,
            'create_timestamp' => $this->create_date,
        );
        return $data_fields;
    }

    public function getArticleStringRawTags()
    {
        $tags = $this->article_tag_alias;
        $tag = array();
        if (!count($tags)) {
            return '';
        }

        foreach ($tags as $tag_model) {
            $tag[] = $tag_model->tag->name ;
        }
        return implode(',', $tag);
    }

    public function incViewCount()
    {
        $this->view_count += 1;
        $this->save();
    }

    public function trash()
    {
        $this->status = self::STATUS_DISABLE;
        return $this->save();
    }

    public function revert()
    {
        $this->status = self::STATUS_ENABLE;
        return $this->save();
    }

    /**
     * 获取搜索结果
     * @param $in_array
     * @return \Phalcon\Mvc\Model\ResultsetInterface
     */
    public static function getSearchResult($in_array)
    {
        $criteria = array('conditions' => "id in (".implode(',', $in_array).")");
        return Article::find($criteria);
    }
} 