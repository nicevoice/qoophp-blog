<?php
/**
 * @author: Rogee<rogeeyang@gmail.com>
 */

namespace Library\Paginator;


use Phalcon\Mvc\User\Component;

class Pager extends Component
{
    private $_data;
    private $_config = array();
    private $_url = '';
    private $_htmlOptions = array();

    private $_is_for_mode = false;

    public function get($data, $param=array(), $htmlOptions=array())
    {
        if($data->total_pages == 1) return;

        $this->_data = $data;
        $this->_htmlOptions = $htmlOptions;

        if(!isset($param['for']) && is_array($param)){
            $this->_url = array_shift($param);
            $this->_config = $param;
        }else{
            $this->_is_for_mode = true;
            $this->_config = $param;
        }


        $data = array(
            $this->_header(),
            $this->_first(),
            $this->_prev(),
            $this->_center(),
            $this->_next(),
            $this->_last(),
            $this->_footer()
        );

        return implode('', $data);
    }

    private function _center()
    {
        $max = $this->_data->total_pages;
        $current = $this->_data->current;

        return $this->_getCenterPager($max, $current);
    }

    private function _getCenterPager($max, $current)
    {
        $min = 1;
        if($max > 10){
            if($current <=5){
                $max = 10;
            }else if($current > 5 && $current <= ($max - 5)){
                $max = $current + 5;
                $min = $current - 5;
            }else if($current > $max - 10){
                $min = $max - 10;
            }
        }

        $html = '';
        for($i = $min; $i<=$max; $i++){
            $class = '';
            if($i == $current){
                $class = 'active';
            }
            $html .= '<li class="'.$class.'"><a href="'.$this->_getUrl($i).'">'.$i.'</a></li>';
        }
        return $html;
    }

    private function _getUrl($page_number){
        $this->_config['page'] = $page_number;
        if($this->_is_for_mode){
            return $this->url->get($this->_config);
        }else{
            return $this->url->get($this->_url, $this->_config);
        }
    }

    private function _prev(){
        if($this->_data->before == $this->_data->current)
        {
            return '';
        }
        $link = $this->_getUrl($this->_data->before);
        return '<li><a class="icon" href="'.$link.'"><</a></li>';
    }

    private function _next()
    {
        if($this->_data->next == $this->_data->current)
        {
            return '';
        }

        $link = $this->_getUrl($this->_data->next);
        return '<li><a class="icon" href="'.$link.'">></a></li>';
    }

    private function _first()
    {
        if($this->_data->current == 1)
        {
            return '';
        }

        $link = $this->_getUrl($this->_data->first);
        return '<li><a class="icon" href="'.$link.'"><<</a></li>';
    }

    private function _last()
    {
        if($this->_data->current == $this->_data->last)
        {
            return '';
        }

        $link = $this->_getUrl($this->_data->last);
        return '<li><a class="icon" href="'.$link.'">>></a></li>';
    }
    private function _header(){
        $wrapper = $this->_htmlOptions['wrapper'];
        $container = $this->_htmlOptions['container'];
        $list_container = $this->_htmlOptions['list'];

        return '<div class="'.$wrapper.'"><div class="'.$container.'"><ul class="'.$list_container.'">';
    }

    private function _footer(){
        return '</ul></div></div>';
    }
} 