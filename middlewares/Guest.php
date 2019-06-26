<?php

namespace middlewares;

use core\MiddlewareAbstract;
use core\Session;

class Guest extends MiddlewareAbstract
{
    use \core\traits\Helper;

    public function run($url)
    {
        if (!empty(Session::get('user')) && Session::get('user') !== null) {
            $this->redirect('/');
        }
    }
}
