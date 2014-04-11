<?php
/**
 * @author: Rogee<rogeeyang@gmail.com>
 */

namespace Library\Exception;

use Phalcon\Mvc\Dispatcher,
    Phalcon\Events\Event,
    Phalcon\Mvc\Dispatcher\Exception as DispatchExceptions;

class DispatchException {
    public function beforeException(Event $event, Dispatcher $dispatcher, $exception)
    {
        //Handle 404 exceptions
        if ($exception instanceof DispatchExceptions) {
            $dispatcher->forward(array(
                'controller' => 'error',
                'action' => 'show404'
            ));
            return false;
        }

        //Handle other exceptions
        $dispatcher->forward(array(
            'controller' => 'error',
            'action' => 'show503'
        ));

        return false;
    }
} 