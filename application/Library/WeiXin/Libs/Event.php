<?php
/**
 * @author: Rogee<rogeeyang@gmail.com>
 */

/**
<xml>
    <ToUserName><![CDATA[toUser]]></ToUserName>
    <FromUserName><![CDATA[FromUser]]></FromUserName>
    <CreateTime>123456789</CreateTime>
    <MsgType><![CDATA[event]]></MsgType>
    <Event><![CDATA[subscribe]]></Event>
</xml>
 *
 * 扫描二维码 用户未关注时的事件推送
<xml>
    <ToUserName><![CDATA[toUser]]></ToUserName>
    <FromUserName><![CDATA[FromUser]]></FromUserName>
    <CreateTime>123456789</CreateTime>
    <MsgType><![CDATA[event]]></MsgType>
    <Event><![CDATA[subscribe]]></Event>
    <EventKey><![CDATA[qrscene_123123]]></EventKey>
    <Ticket><![CDATA[TICKET]]></Ticket>
</xml>
 *
 * 用户已关注时的事件推送
<xml>
    <ToUserName><![CDATA[toUser]]></ToUserName>
    <FromUserName><![CDATA[FromUser]]></FromUserName>
    <CreateTime>123456789</CreateTime>
    <MsgType><![CDATA[event]]></MsgType>
    <Event><![CDATA[SCAN]]></Event>
    <EventKey><![CDATA[SCENE_VALUE]]></EventKey>
    <Ticket><![CDATA[TICKET]]></Ticket>
</xml>
 *
 *
 * 上报地理位置事件 进入会话后每5秒
<xml>
    <ToUserName><![CDATA[toUser]]></ToUserName>
    <FromUserName><![CDATA[fromUser]]></FromUserName>
    <CreateTime>123456789</CreateTime>
    <MsgType><![CDATA[event]]></MsgType>
    <Event><![CDATA[LOCATION]]></Event>
    <Latitude>23.137466</Latitude>
    <Longitude>113.352425</Longitude>
    <Precision>119.385040</Precision>
</xml>
 *
 *
 * 自定义菜单事件
<xml>
    <ToUserName><![CDATA[toUser]]></ToUserName>
    <FromUserName><![CDATA[FromUser]]></FromUserName>
    <CreateTime>123456789</CreateTime>
    <MsgType><![CDATA[event]]></MsgType>
    <Event><![CDATA[CLICK]]></Event>
    <EventKey><![CDATA[EVENTKEY]]></EventKey>
</xml>
 */
namespace Library\WeiXin\Libs;


class Event extends WeiXinInstance
{
    public $Event;//subscribe; unsubscribe;
    public $EventKey; //事件KEY值，qrscene_为前缀，后面为二维码的参数值
    public $Ticket; //二维码的ticket，可用来换取二维码图片

    public function getResult()
    {
        $this->Event = sprintf("%s", $this->_data->Event);
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