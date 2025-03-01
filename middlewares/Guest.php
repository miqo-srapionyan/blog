<?php

declare(strict_types=1);

namespace middlewares;

use core\MiddlewareAbstract;
use core\Session;
use core\traits\Helper;

class Guest extends MiddlewareAbstract
{
    use Helper;

    public function run($url)
    {
        if (!empty(Session::get('user')) && Session::get('user') !== null) {
            $this->redirect('/');
        }
    }
}
