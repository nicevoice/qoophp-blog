<?php
function getConf($name){
    $dir = dirname(__FILE__) . '/_conf_common/';
    $file = $dir . $name . '.conf.php';
    $conf = require $file;
    return $conf;
}
function getFunc($name) {
    global $config, $di;
    $dir = dirname(__FILE__) . '/_func_common/';
    $file = $dir . $name . '.service.php';
    $conf = require $file;
    return $conf();
}

function dump($param){
    var_dump($param);exit;
}