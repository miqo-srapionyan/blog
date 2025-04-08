<?php

declare(strict_types=1);

namespace middlewares;

use core\BaseMiddleware;
use core\Session;
use core\traits\Redirect;

class Authentication extends BaseMiddleware
{
    use Redirect;

    public function run(string $url): void
    {
        if (!Session::has('user')) {
            $this->redirect('/login');
        }
    }
}
