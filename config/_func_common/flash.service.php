<?php
$function = function () {
    $flash = new \Phalcon\Flash\Session(array(
        'error' => 'alert alert-danger',
        'success' => 'alert alert-success',
        'notice' => 'alert alert-info',
    ));
    return $flash;
};
return $function;