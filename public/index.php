<?php
defined("_FRONTEND_") or define("_FRONTEND_", true);

include dirname(__FILE__) . "/../config/common.inc.php";
include ROOT_PATH . "/config/common.function.php";

try {
    $config = include APP_PATH ."../config/config.php";
    $config = new \Phalcon\Config( $config );

    //register dir
    $loader = new \Phalcon\Loader();
    $register_dir = getConf("register_dir");//$config->register_dir;
    $loader->registerNamespaces($register_dir);
    $loader->register();

    $di = new \Phalcon\DI\FactoryDefault();
    include ROOT_PATH ."config/services.php";

    $application = new \Phalcon\Mvc\Application( $di );
    echo $application->handle()->getContent();
}
catch ( \Exception $e ) {
    echo "<pre>";
    echo sprintf("[%s]<b>[%d]</b>[%s]", $e->getFile(), $e->getLine(), $e->getMessage());
    echo "</pre>";
}
