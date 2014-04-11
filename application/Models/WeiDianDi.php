<?php
/**
 * @author: Rogee<rogeeyang@gmail.com>
 */

namespace Models;

use Common\ModelCommon;

class WeiDianDi extends ModelCommon
{
    public function getDate()
    {
        return date("m.d", $this->create_date);
    }
    public function getTime()
    {
        $hour = date("H", $this->create_date);
        $apm = "上午";
        if($hour > 12){
            $apm = "下午";
        }
        $hour = $apm . " " .date("H:i", $this->create_date);
        return $hour;
    }

    public function saveMessage($data)
    {
        $model = new WeiDianDi();
        $data_save = array(
            'content' => $data->content,
            'extra' => $this->getExtraInfo($data),
            'type' => $data->type
        );
        $ret = $model->save($data_save);
        return $ret;
    }

    public function getExtraInfo($data)
    {
        return '';
    }

    public function getReplyMessage($replyModel)
    {
        $replyModel->setContent('保存成功');
        $replyModel->setType("text");
    }
} 