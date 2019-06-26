<?php

namespace middlewares;

use core\MiddlewareAbstract;
use core\Session;

class Authentication extends MiddlewareAbstract
{
    use \core\traits\Helper;

    public function run($url)
    {
        if (Session::get('user') === null || empty(Session::get('user'))) {
            $this->redirect('/login');
        }
    }
}
