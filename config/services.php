<?php
$di->set('url', getFunc("url"), TRUE);
$di->set('view', getFunc("view"), TRUE);
$di->set('db', getFunc('database'));
$di->set('session', getFunc("session"));
$di->set('flash', getFunc('flash'));
$di->set('config', getFunc('config'));
$di->set('dispatcher', getFunc('dispatcher'));
$di->set('router', getFunc('router'));

// custom
$di->set('setting', getFunc('setting'));
$di->set('page', getFunc('page'));
$di->set('auth', getFunc('auth'));
$di->set('widget', getFunc('widget'));
$di->set('widget_view', getFunc('widget_view'));
