<?php
namespace Common;

use Phalcon\Mvc\Controller;
class ControllerBase extends Controller
{

    public function checkIsGuest($dispatcher)
    {
        $module = $dispatcher->getModuleName();
        $controller = $dispatcher->getControllerName();
        $action = $dispatcher->getActionName();

        if ($controller == 'login' && $action == 'index') {
            return;
        }

        if ($this->auth->isGuest()) {
            $this->redirect('login/index');
        }
    }

    /**
     * 查看网站是否下线
     * @param $dispatcher
     */
    public  function checkIsWebsiteOffLine($dispatcher)
    {
        // Executed before every found action
        $is_closed = Setting::findFirstByAlias('is_open')->config;
        $module = $dispatcher->getModuleName();
        $action = $dispatcher->getActionName();
        if ($is_closed == "on" && $module == 'frontend' && $action != 'offLine') {
            $this->dispatcher->forward(array('controller' => 'error', 'action' => 'offLine'));
        }
    }

    public function setVar($key, $value)
    {
        $this->view->setVar($key, $value);
    }

    public function redirect($route)
    {
        return $this->response->redirect($route);
    }

    public function forward($route)
    {
        list($controller, $action) = explode('/', $route);
        $arr = array(
            'controller' => $controller,
            'action' => $action
        );
        return $this->dispatcher->forward($arr);
    }

    /**
     * 设置Title
     * @param $title
     */
    public function setTitle($title)
    {
        \Phalcon\Tag::prependTitle($title . ' - ');
    }

    /**
     * 返回一套JSON数据
     * @param bool $status
     * @param string $msg
     * @param string $extra
     */
    public function json($status = true, $msg = "操作成功", $extra = "")
    {
        $data = array(
            'status' => $status,
            'msg' => $msg,
            'extra' => $extra
        );

        header('Content-type:application/json;charset=utf-8');
        echo json_encode($data);
        $this->view->disable();
        exit;
    }

    /**
     * 获取数据分页
     * @param     $model
     * @param     $page
     * @param int $limit
     *
     * @return \Phalcon\Paginator\Adapter\stdClass
     */
    public function getPagination($model, $page, $limit = 10)
    {
        if ($page <= 0) {
            $page = 1;
        }

        $pager = new \Phalcon\Paginator\Adapter\Model(
            array(
                "data" => $model,
                "limit" => $limit,
                "page" => $page
            )
        );
        return $pager->getPaginate();
    }
}
