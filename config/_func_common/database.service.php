<?php
$function = function () use ($config) {
    $db_config = array(
        'host' => $config->database->host,
        'username' => $config->database->username,
        'password' => $config->database->password,
        'dbname' => $config->database->dbname,
        'charset' => 'utf8'
    );

    return new \Phalcon\Db\Adapter\Pdo\Mysql($db_config);
};
return $function;