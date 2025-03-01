<?php

declare(strict_types=1);

namespace middlewares;

use core\MiddlewareAbstract;
use core\Session;
use core\traits\Helper;

class Admin extends MiddlewareAbstract
{
    use Helper;

    public function run($url)
    {
        if (Session::get('user')['role'] !== 'admin') {
            $this->redirect('/');
        }
    }
}