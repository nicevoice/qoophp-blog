<?php
namespace Controllers;

use Common\BackendControllerBase;
use Models\Administrator;
use Models\Setting;
class SettingController extends BackendControllerBase
{

    public function indexAction()
    {
        $this->setTitle('网站参数设置');
        $setting = Setting::getSettings();
        $this->view->setVar('setting', $setting);
    }

    // save all user input setting values
    public function saveAction()
    {
        $setting = $this->request->getPost('setting');
        $result = Setting::saveSettings($setting);
        $this->json($result);
    }

    /**
     * 用户设置
     */
    public function userAction()
    {
        $user = Administrator::findFirstById($this->auth->getId());

        if( $this->request->isPost() ){
            if(empty($_POST['password'])){
                $user->nickname = $this->request->getPost('nickname', 'string');
            }else{
                if($_POST['password'] != $_POST['repassword']){
                    $this->flash->error('两次密码输入不一至');
                    return $this->redirect('user');
                }
                $user->nickname = $this->request->getPost('nickname', 'string');
                $user->salt = $user->getHashCode();
                $user->password = $user->hashPassword($_POST['password'], $user->salt);
            }

            if(!$user->save()){
                var_dump($user->getMessages());exit;
            }

            $this->auth->refreshSessionData($user);
            $this->flash->success('保存成功');
        }
        $form = new \Form\UserSettingForm($user);
        $this->view->setVar('form', $form);
    }

}

