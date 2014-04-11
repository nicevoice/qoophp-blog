<?php
/**
 * @author: Rogee<rogeeyang@gmail.com>
 */

namespace Models;


use Common\ModelCommon;
use Library\WeiXin\WeiXinReply;
use Phalcon\Validation;

class Weixin extends ModelCommon
{
    public function getObject()
    {
        $obj = $this->_di('weixin')->init();
        $ret = $this->saveMsg($obj);
        $reply = new WeiXinReply($obj);

        if ($ret && $this->isSaveAble()) {
            $diandi = new WeiDianDi();
            $ret = $diandi->saveMessage($this);
            if ($ret) {
                $diandi->getReplyMessage($reply);
                return $reply;
            }
        }

        $this->getReplyMessage($reply);
        return $reply;
    }

    public function getReplyMessage($replyModel)
    {
        $replyModel->setContent('不认识，别乱发！');
        $replyModel->setType('text');
    }

    /**
     * 微信消息保存到数据库
     * @param $obj
     * @return array
     */
    public function saveMsg($obj)
    {
        $data = array(
            'msg_id' => sprintf("%s", $obj->MsgId),
            'from' => sprintf("%s", $obj->FromUserName),
            'to' => sprintf("%s", $obj->ToUserName),
            'type' => sprintf("%s", $obj->MsgType),
            'content' => $obj->getContent(),
            'event' => $obj->getEvent(),
        );
        $ret = $this->save($data);
        return $ret;
    }

    /**
     * 判定是否可以保存此类消息文本
     * @return bool
     */
    public function isSaveAble()
    {
        $can_be_save = array('text');
        if (in_array(strtolower($this->type), $can_be_save)) {
            return true;
        }
        return false;
    }
} 