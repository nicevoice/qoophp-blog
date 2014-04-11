<?php
$function = function () use ($config, $di) {
    $view = new \Phalcon\Mvc\View();

    $engine_config = array(
        '.html' => function ($view, $di) use ($config) {
                $volt = new \Phalcon\Mvc\View\Engine\Volt($view, $di);
                $options_config = array(
                    'compiledPath' => $config->common->cacheDir,
                    'compiledSeparator' => '_'
                );
                $volt->setOptions($options_config);
                return $volt;
            }
    );

    $view->registerEngines($engine_config);
    $view->setViewsDir($config->common->viewDir);
    return $view;
};
return $function;