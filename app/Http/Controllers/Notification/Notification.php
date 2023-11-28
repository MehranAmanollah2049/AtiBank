<?php

namespace App\Http\Controllers\Notification;


class Notification {

    public function __call($name, $arguments)
    {
        
        $obj_class = 'App\Http\Controllers\Notification\Providers\\' . substr($name,4) . 'Provider';
        $model = new $obj_class(...$arguments);
        $model->send();

    }
}