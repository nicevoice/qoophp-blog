<?php
/**
 * @author: Rogee<rogeeyang@gmail.com>
 *
<xml>
    <ToUserName><![CDATA[toUser]]></ToUserName>
    <FromUserName><![CDATA[fromUser]]></FromUserName>
    <CreateTime>1348831860</CreateTime>
    <MsgType><![CDATA[text]]></MsgType>
    <Content><![CDATA[this is a test]]></Content>
    <MsgId>1234567890123456</MsgId>
</xml>
 */

namespace Library\WeiXin\Libs;


class Text extends WeiXinInstance
{
    public $Content;

    public function getResult(){
        $this->Content = sprintf("%s", $this->_data->Content);;

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