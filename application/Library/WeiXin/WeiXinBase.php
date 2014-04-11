<?php
/**
 * @author: Rogee<rogeeyang@gmail.com>
 */

namespace Library\WeiXin;


use Phalcon\Mvc\User\Component;

class WeiXinBase extends Component
{
    private $_token = 'weidiandi';
    private $_receive_message = null;

    public $token = '';
    private $service_url = 'https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token=';
    private $token_url = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=%s&secret=%s';

    public function init()
    {
        // 检查消息合法
//        if (!$this->checkSignature())
//            return false;

        //初始化消息结构
        $msg = $this->initReceiveMessage();
        if (false == $msg)
            return false;

        return $msg;
    }

    /**
     * 固化发送来的消息
     * @return bool
     */
    private function initReceiveMessage()
    {
        $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
        if (empty($postStr))
            return false;

        $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
        $class_name = ucfirst($postObj->MsgType);
        $class = '\Library\WeiXin\Libs\\' . ucfirst($postObj->MsgType);

        if (!file_exists(dirname(__FILE__) . '/Libs/' . $class_name . '.php'))
            return false;

        return (new $class($postObj))->getResult();
    }

    /**
     * 检测消息来源的合法性
     * @return bool
     */
    private function checkSignature()
    {
        if(DEBUG_MODE)
            return true;

        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];

        $token = $this->_token;
        $tmpArr = array($token, $timestamp, $nonce);
        sort($tmpArr, SORT_STRING);
        $tmpStr = implode($tmpArr);
        $tmpStr = sha1($tmpStr);

        if ($tmpStr == $signature) {
            return true;
        }
        return false;
    }


    /**
     * 给用户回复消息 高级用户使用
     * @param $user
     * @param $type
     * @param $data
     */
    public function send($user, $type, $data)
    {
        $post_url = $this->service_url . $this->token;
        $data_tpl = array(
            'touser' => $user,
            'msgtype' => $type,
            $type => $data
        );
    }

    /**
     * 获取TOKEN 高级用户使用
     */
    public function getAccessToken()
    {

    }
}

?>