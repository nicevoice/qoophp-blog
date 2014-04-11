<?php
namespace Controllers;

use Common\BackendControllerBase;

class ErrorController extends BackendControllerBase
{
    public function show404Action()
    {
        $this->response->setHeader('HTTP/1.0 404','Not Found');
        echo '404';exit;
    }

    public function show503Action()
    {
        echo 503;exit;
    }
}

