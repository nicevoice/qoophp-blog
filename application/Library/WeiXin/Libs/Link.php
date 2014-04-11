<?php
/**
 * @author: Rogee<rogeeyang@gmail.com>
 */

/**
<xml>
    <ToUserName><![CDATA[toUser]]></ToUserName>
    <FromUserName><![CDATA[fromUser]]></FromUserName>
    <CreateTime>1351776360</CreateTime>
    <MsgType><![CDATA[link]]></MsgType>
    <Title><![CDATA[公众平台官网链接]]></Title>
    <Description><![CDATA[公众平台官网链接]]></Description>
    <Url><![CDATA[url]]></Url>
    <MsgId>1234567890123456</MsgId>
</xml>
 */
namespace Library\WeiXin\Libs;


class Link extends WeiXinInstance
{
    public $Title;
    public $Description;
    public $Url;

    public function getResult()
    {
        $this->Title = sprintf("%s", $this->_data->Title);
        $this->Description = sprintf("%s", $this->_data->Description);
        $this->Url = sprintf("%s", $this->_data->Url);
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