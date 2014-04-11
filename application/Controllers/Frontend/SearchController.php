<?php
/**
 * @author: Rogee<rogeeyang@gmail.com>
 */

namespace Controllers;


use Common\FrontControllerBase;
use Library\Paginator\Pager;
use Models\Article;

//include sphinx
class SearchController extends FrontControllerBase
{
    public function initialize()
    {
        $this->setTitle('搜索');
        parent::initialize();
    }
    public function indexAction()
    {
        $this->view->setTemplateAfter('columns');

        $keyword = $this->request->get('q');
        if(trim($keyword) == ''){
            return $this->view->pick('search/noitem');
        }
        $this->setVar('key', $keyword);

        $page_cnt = 10;
        $current = $this->request->get('page', 'int', 1);
        $page_start = ($current - 1)*$page_cnt;

        $cl = new \Library\SphinxClient();
        $cl->SphinxClient();
        $cl->SetServer ( '127.0.0.1', 9312);
        //以下设置用于返回数组形式的结果
        $cl->SetArrayResult ( true );
        //取从头开始的前20条数据，0,20类似SQl语句的LIMIT 0,20
        $cl->SetLimits($page_start, $page_cnt);
        //在做索引时，没有进行 sql_attr_类型 设置的字段，可以作为“搜索字符串”，进行全文搜索
        $res = $cl->Query( $keyword, "main_qoo_blog" );    //"*"表示在所有索引里面同时搜索，"索引名称（例如test或者test,test2）"则表示搜索指定的
        $total = $res['total_found'];

        if($total == 0){//什么也米找着
            return $this->view->pick('search/noitem');
        }

        $in_array = array();
        foreach($res['matches'] as $item){
            $in_array[] = $item['id'];
        }

        //根据ID查找数据
        $data = Article::getSearchResult($in_array);
        $this->setVar('data', $data);

        //给PAGER数据
        $pager = new \Library\Paginator\Adapter\Search(array(
            'total_pages' => ceil($total/10),
            'current' => $current
        ));

        $this->setVar('pages', $pager);
    }
} 