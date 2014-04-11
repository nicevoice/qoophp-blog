<?php
/**
 * @author: Rogee<rogeeyang@gmail.com>
 */
/**
<xml>
    <ToUserName><![CDATA[toUser]]></ToUserName>
    <FromUserName><![CDATA[fromUser]]></FromUserName>
    <CreateTime>1351776360</CreateTime>
    <MsgType><![CDATA[location]]></MsgType>
    <Location_X>23.134521</Location_X>
    <Location_Y>113.358803</Location_Y>
    <Scale>20</Scale>
    <Label><![CDATA[位置信息]]></Label>
    <MsgId>1234567890123456</MsgId>
</xml>
 */
namespace Library\WeiXin\Libs;


class Location extends WeiXinInstance
{
    public $Location_X;
    public $Location_Y;
    public $Scale;
    public $Label;

    public function getResult()
    {
        $this->Location_X = sprintf("%s", $this->_data->Location_X);
        $this->Location_Y = sprintf("%s", $this->_data->Location_Y);
        $this->Scale = sprintf("%s", $this->_data->Scale);
        $this->Label = sprintf("%s", $this->_data->Label);

        return $this;
    }

    public function getContent()
    {
        return $this->Content;
    }

    public function restoreContent()
    {
        return $this->Content;
    }
} 