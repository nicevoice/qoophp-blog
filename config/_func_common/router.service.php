<?php
$function = function () {
    $router = new \Phalcon\Mvc\Router();
    $router->removeExtraSlashes(true);

    $router->add('/:controller/(\d+)[/]{0,1}(.*?)', array(
        'controller' => 1,
        'action' => 'index',
        'id' => 2,
        'params' => 3,
    ));

    $router->add('/:controller/:action/(\d+)', array(
        'controller' => 1,
        'action' => 2,
        'id' => 3
    ));

    $router->add('/tag', array(
        'controller' => 'archives',
        'action' => 'tag',
    ));

    $router->add('/weidiandi', array(
        'controller' => 'weixin',
        'action' => 'receive'
    ));

    //index-page
    $route = $router->add('/{page:[0-9]+}/:params', array(
        'controller' => 'index',
        'action' => 'index',
    ));
    $route->setName("index-page");

    //tag-rewrite
    $route = $router->add('/tag-{tag}-{page}', array(
        'controller' => 'archives',
        'action' => 'tagName',
    ));
    $route->setName("tag-page");

    //    category-rewrite
    $route = $router->add('/cat/{slug}/{page}', array(
        'controller' => 'category',
        'action' => 'article',
    ));
    $route->setName("category-page");

    //    book-mark
    $route = $router->add('/bookmark/{page:\d+}', array(
        'controller' => 'bookmark',
        'action' => 'index',
    ));
    $route->setName('bookmark-page');

    return $router;
};
return $function;