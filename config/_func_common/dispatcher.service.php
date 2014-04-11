<?php
$function = function () use ($di) {
    $dispatcher = new \Phalcon\Mvc\Dispatcher();
    $dispatcher->setDefaultNamespace('Controllers');
    if( !defined("DEBUG_MODE") && !DEBUG_MODE )
    {
        $evManager = $di->getShared('eventsManager');

        $evManager->attach(
            "dispatch:beforeException",
            function($event, $dispatcher, $exception)
            {
                $dispatcher->forward(
                    array(
                        'controller' => 'error',
                        'action'     => 'show404',
                    )
                );
                return false;
            }
        );
        $dispatcher->setEventsManager($evManager);
    }

    return $dispatcher;
};
return $function;
