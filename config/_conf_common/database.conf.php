<?php
$db_debug = array(
    'adapter'  => 'Mysql' ,
    'host'     => 'localhost' ,
    'username' => 'root' ,
    'password' => '' ,
    'dbname'   => 'qoo_blog' ,
);

$db_pro = array(
    'adapter'  => 'Mysql' ,
    'host'     => 'localhost' ,
    'username' => 'qoo_blog' ,
    'password' => 'qoo_blog_sql_admin' ,
    'dbname'   => 'qoo_blog' ,
);

if( DEBUG_MODE ){
    return $db_debug;
}else{
    return $db_pro;
}