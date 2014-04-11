<?php
/**
 * @author: Rogee<rogeeyang@gmail.com>
 */

namespace Library\WeiXin\Libs;


abstract class WeiXinInstance
{
    public $FromUserName;
    public $ToUserName;
    public $MsgType;
    public $FuncFlag;
    public $MsgId;

    protected $_data;

    abstract public function getResult();
    abstract public function getContent();
    abstract public function restoreContent();

    public function __construct($data)
    {
        $this->_data = $data;
        $this->FromUserName = sprintf("%s", $data->FromUserName);
        $this->ToUserName = sprintf("%s", $data->ToUserName);
        $this->MsgType = sprintf("%s", $data->MsgType);
        $this->FuncFlag = sprintf("%s", $data->FuncFlag);
        $this->MsgId = sprintf("%s", $data->MsgId);
    }

    public function getType()
    {
        return $this->MsgType;
    }

    public function getVars()
    {
        $data = array(

        );
        return $data;
    }

    public function getEvent(){
        if(isset($this->Event)){
            return $this->Event;
        }
        return "";
    }
}