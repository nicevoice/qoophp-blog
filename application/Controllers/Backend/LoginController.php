<?php
/**
 * @author: Rogee<rogeeyang@gmail.com>
 */
namespace Controllers;

use Common\BackendControllerBase;
use Phalcon\Mvc\View;

class LoginController extends BackendControllerBase
{

    public function indexAction()
    {
        if($this->request->isPost()){
            $auth_info = $this->request->getPost();
            if($this->auth->check($auth_info)){
                return $this->redirect('index/index');
            }
            $this->flash->error('登陆失败！');
        }
    }

    public function logOutAction()
    {
        $this->auth->remove();
        $this->redirect('login/index');
    }
} 