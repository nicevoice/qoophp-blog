<?php
$function = function () use ($config) {
    $url = new \Phalcon\Mvc\Url();
    $baseUrl = $config->common->baseUrl;
    $url->setBaseUri($baseUrl);
    return $url;
};
return $function;