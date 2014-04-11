<?php
/**
 * @author: Rogee<rogeeyang@gmail.com>
 */

namespace Controllers;


use Common\FrontControllerBase;
use Phalcon\Mvc\View;

class ErrorController extends FrontControllerBase
{
    public function emptyInfoAction()
    {
    }

    public function offLineAction()
    {
        $this->view->setRenderLevel(View::LEVEL_ACTION_VIEW);

        $off_line_info = Setting::findFirstByAlias('close_info')->config;
        $this->view->setVar('info', $off_line_info);
    }

    public function page404Action(){
        header("404 not found", null, 404);
    }
}