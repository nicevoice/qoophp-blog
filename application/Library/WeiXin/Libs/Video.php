<?php
/**
 * @author: Rogee<rogeeyang@gmail.com>
 */

/**
<xml>
    <ToUserName><![CDATA[toUser]]></ToUserName>
    <FromUserName><![CDATA[fromUser]]></FromUserName>
    <CreateTime>1357290913</CreateTime>
    <MsgType><![CDATA[video]]></MsgType>
    <MediaId><![CDATA[media_id]]></MediaId>
    <ThumbMediaId><![CDATA[thumb_media_id]]></ThumbMediaId>
    <MsgId>1234567890123456</MsgId>
</xml>
 */
namespace Library\WeiXin\Libs;


class Video extends WeiXinInstance
{
    public $MediaId;
    public $ThumbMediaId;
    public function getResult()
    {
        $this->MediaId = sprintf("%s", $this->_data->MediaId);
        $this->ThumbMediaId = sprintf("%s", $this->_data->ThumbMediaId);

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