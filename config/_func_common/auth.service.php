<?php
$function = function () use ($config) {
    return new \Library\Auth\Auth();
};
return $function;