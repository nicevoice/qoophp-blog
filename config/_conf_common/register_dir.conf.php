<?php
if(defined("_FRONTEND_") && _FRONTEND_ ){
    $controller_path = CONTROLLER_PATH . "/Frontend/";
}else{
    $controller_path = CONTROLLER_PATH . "/Backend/";
}

$common_dir = array(
    'Controllers' => $controller_path,
    'Models' => MODEL_PATH,
    'Library' => LIB_PATH,
    'Common' => COMMON_PATH,
    'Widgets' => WIDGET_PATH,
    'Form' => FORM_PATH
);

return $common_dir;