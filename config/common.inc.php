<?php
if(file_exists(dirname(__FILE__).'/../public/production.env')){
    define("DEBUG_MODE", false);
    error_reporting(0);
}else{
    error_reporting( E_ALL^E_NOTICE  );
    define("DEBUG_MODE", true);
}

// define const
define('ROOT_PATH' , dirname( __FILE__ ) . '/../' );
define('APP_PATH' , dirname( __FILE__ ) . '/../application/' );
define('CONTROLLER_PATH', APP_PATH . 'Controllers');
define('MODEL_PATH', APP_PATH . 'Models');
define('MODULE_PATH', APP_PATH . 'Modules');
define('VIEW_PATH', APP_PATH . 'Views');
define('FORM_PATH', APP_PATH . 'Form');
define('COMMON_PATH', APP_PATH . 'Components');
define('LIB_PATH', APP_PATH . 'Library');
define('WIDGET_PATH', APP_PATH . 'Widgets');

define('CACHE_PATH', APP_PATH . '../cache/');
define("UPLOAD_PATH", realpath(APP_PATH.'../public/uploads/'));
define('IMAGE_BASE_URI', '/uploads');