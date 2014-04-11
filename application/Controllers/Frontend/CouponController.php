<?php
/**
 * @author: Rogee<rogeeyang@gmail.com>
 */

namespace Controllers;


use Common\FrontControllerBase;
use Models\Coupon;

class CouponController extends FrontControllerBase
{
    public function indexAction()
    {
        $this->setTitle('获取折扣码！');
        $used_coupons = Coupon::getUsedTen();
        $this->setVar('coupons', $used_coupons);
    }

    public function removeAction()
    {
        if ($this->request->isAjax())
        {
            $code = $this->request->get('id');
            $model = Coupon::findFirstBySerial($code);
            if (!$model) {
                $content =  "非法ID";
            }else{
                $model->deleteItem();
                $content = "操作成功";
            }
            $this->json(true, $content);
        }
    }

    public function checkAction()
    {
        if ($this->request->isAjax())
        {
            $code = $this->request->get('id');
            $model = Coupon::findFirstBySerial($code);
            if (!$model) {
                $content =  "非法ID";
            }else{
                $content = "抵用：" . $model->discount;
                if($model->remove == 1){
                    $content = "[已作废]" . $content;
                }
            }
            $this->json(true, $content);
        }
    }

    public function getAction()
    {
        if ($this->request->isAjax()) {

            $ip = $this->request->getClientAddress();
            $date = strtotime(date("Y-m-d"));

            $model = Coupon::findFirst(array(
                'conditions' => 'create_date > ?0 and ip = ?1',
                'bind' => array($date, $ip)
            ));
            if ($model) {
                $content = sprintf('这是您今天的优惠码<br /> %s <br />抵用 %.2f RMB', $model->serial, $model->discount);
                if($model->remove == 1){
                    $content = "[已作废]" . $content;
                }
            } else {
                $model = new Coupon();
                $tmp_str = 'abcdefg!@&^)%(&^';
                $model->ip = $ip;
                $model->serial = md5(uniqid() . str_shuffle($tmp_str) . uniqid());
                $model->discount = $model->getDiscount();
                if ($model->save()) {
                    $content = sprintf('这是您今天的优惠码<br /> %s <br />抵用 %.2f RMB', $model->serial, $model->discount);
                } else {
                    $content = "获取出错";
                }
            }

            $this->json(true, $content);
        }
    }

} 