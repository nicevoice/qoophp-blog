<?php
/**
 * @author: Rogee<rogeeyang@gmail.com>
 */

namespace Library\Paginator\Adapter;
use Phalcon\Exception;

/**
 * Phalcon\Paginator\Adapter\Model
 *
 * This adapter allows to paginate data using a Phalcon\Mvc\Model resultset as base
 */

class Search implements \Phalcon\Paginator\AdapterInterface {

    protected $_limitRows;

    protected $_config;

    protected $_page;

    public $total_pages;
    public $current;
    public $before;
    public $last;
    public $next;


    public function __construct($config){
        $this->_config = $config;

        if(!isset($config['current'])){
            throw new Exception("current 字段没有设置");
        }

        if(!isset($config['total_pages'])){
            throw new Exception("total_pages 字段没有设置");
        }

        foreach($this->_config as $key => $value ){
            $this->$key = $value;
        }

        //给BEFORE赋值
        $this->before = $this->current - 1;
        if($this->before <= 0){
            $this->before = 1;
        }

        //给最后一个赋值
        $this->last = $this->total_pages;

        //给下一个赋值
        $this->next = $this->current + 1;
        if($this->next > $this->last){
            $this->next = $this->last;
        }
    }


    /**
     * Set the current page number
     *
     * @param int $page
     */
    public function setCurrentPage($page){
        $this->_page = intval($page);
    }


    /**
     * Returns a slice of the resultset to show in the pagination
     *
     * @return stdClass
     */
    public function getPaginate(){ }

}