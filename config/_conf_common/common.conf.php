<?php
if(defined("_FRONTEND_") && _FRONTEND_){
    $cachePath =  "/Frontend/" ;
    $baseUrl = '/';
    $viewDir = VIEW_PATH . '/Frontend/';
}else{
    $cachePath =  "/Backend/";
    $baseUrl = '/admin/';
    $viewDir = VIEW_PATH . '/Backend/';
}
return array(
    'cacheDir' => CACHE_PATH . $cachePath ,
    'baseUrl' => $baseUrl,
    'viewDir' => $viewDir
);