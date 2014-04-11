<?php
/**
 * @author: Rogee<rogeeyang@gmail.com>
 */
/**
<xml>
    <ToUserName><![CDATA[toUser]]></ToUserName>
    <FromUserName><![CDATA[fromUser]]></FromUserName>
    <CreateTime>1357290913</CreateTime>
    <MsgType><![CDATA[voice]]></MsgType>
    <MediaId><![CDATA[media_id]]></MediaId>
    <Format><![CDATA[Format]]></Format>
    <MsgId>1234567890123456</MsgId>
</xml>
 *
 *开启语音识别后
<Recognition><![CDATA[腾讯微信团队]]></Recognition>
 */
namespace Library\WeiXin\Libs;


class Voice extends WeiXinInstance
{
    public $Format;
    public $MediaId;
    public $Recognition;
    
    public function getResult()
    {
        $this->Format = sprintf("%s", $this->_data->Format);
        $this->MediaId = sprintf("%s", $this->_data->MediaId);
        $this->Recognition = sprintf("%s", $this->_data->Recognition);

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

    /**
     * 是否开启语音识别
     * @return bool
     */
    public function isVoiceRecognitionOpen()
    {
        return !empty($this->Recognition);
    }
} 