<?php
$function = function () {
    $session = new \Phalcon\Session\Adapter\Files();
    $session->start();

    return $session;
};
return $function;