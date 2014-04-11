<?php
/**
 * @author: Rogee<rogeeyang@gmail.com>
 */

/**
<xml>
    <ToUserName><![CDATA[toUser]]></ToUserName>
    <FromUserName><![CDATA[fromUser]]></FromUserName>
    <CreateTime>1348831860</CreateTime>
    <MsgType><![CDATA[image]]></MsgType>
    <PicUrl><![CDATA[this is a url]]></PicUrl>
    <MediaId><![CDATA[media_id]]></MediaId>
    <MsgId>1234567890123456</MsgId>
</xml>
 */
namespace Library\WeiXin\Libs;


class Image extends WeiXinInstance
{
    public $MediaId;
    public $PicUrl;

    public function getResult()
    {
        $this->MediaId = sprintf("%s", $this->_data->MediaId);
        $this->PicUrl = sprintf("%s", $this->_data->PicUrl);
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