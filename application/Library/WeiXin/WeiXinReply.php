<?php
/**
 * @author: Rogee<rogeeyang@gmail.com>
 */

namespace Library\WeiXin;


class WeiXinReply {
    public $FromUserName;
    public $ToUserName;
    public $CreateTime;
    public $MsgType;
    public $Content;

    public function __construct($data)
    {
        $this->ToUserName = $data->FromUserName;
        $this->FromUserName = $data->ToUserName;
        $this->CreateTime = time();
    }
    public function setType($type)
    {
        $this->MsgType = $type;
    }

    public function getType()
    {
        return $this->MsgType;
    }

    public function setContent($content){
        $this->Content = $content;
    }
} 