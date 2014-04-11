<?php
/**
 * @author: Rogee<rogeeyang@gmail.com>
 */

namespace Models;


use Common\ModelCommon;

class Administrator extends ModelCommon
{
    /**
     * 获取一个4位的随机码
     * @return string
     */
    public function getHashCode()
    {
        return substr(md5(uniqid()), mt_rand(0,28), 4);
    }

    /**
     * 根据传入的值加密用户密码
     * @param $raw
     * @param $hash_code
     * @return string
     */
    public function hashPassword($raw, $hash_code)
    {
        return md5($hash_code.$raw.$hash_code);
    }

    /**
     * 比较用户密码与数据库密码
     * @param $raw
     * @return bool
     */
    public function comparePassword($raw)
    {
        $input_password_hash = $this->hashPassword($raw, $this->salt);
        $database_password = $this->password;

        return $database_password == $input_password_hash;
    }

    /**
     * 更新登陆信息
     */
    public function updateLoginInfo()
    {
        $this->login_ip = $this->getDI()->getRequest()->getClientAddress();
        $this->save();
    }
}