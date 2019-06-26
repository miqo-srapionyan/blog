<?php

namespace middlewares;

use core\MiddlewareAbstract;
use core\Session;

class Admin extends MiddlewareAbstract
{
    use \core\traits\Helper;

    public function run($url)
    {
        if (Session::get('user')['role'] !== 'admin') {
            $this->redirect('/');
        }
    }
}