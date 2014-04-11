<?php
namespace Controllers;

use Common\BackendControllerBase;
use Phalcon\Mvc\View;

class IndexController extends BackendControllerBase
{
    public function indexAction()
    {
        $this->view->setRenderLevel(View::LEVEL_LAYOUT);
        $this->view->setLayout('frame');
    }

    public function welcomeAction()
    {
    }
}

