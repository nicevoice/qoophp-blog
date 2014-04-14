<?php
/**
 * @author: Rogee<rogeeyang@gmail.com>
 */

namespace Models;


use Common\ModelCommon;

class Coupon extends ModelCommon
{
    public function getDiscount()
    {
        $count = sprintf("%d.%d", intval(mt_rand(0,3)), intval(mt_rand(50,99)));
        return $count;
    }

    public function deleteItem()
    {
        $this->remove = 1;
        $this->save();
    }

    /**
     * 获取10个已经使用的
     * @return \Phalcon\Mvc\Model\ResultsetInterface
     */
    public static function getUsedTen()
    {
        $criteria = array(
            'conditions' => 'remove = 1',
            'limit' => 15,
            'order' => 'update_date desc'
        );
        $model = self::find($criteria);
        return $model;
    }
} 