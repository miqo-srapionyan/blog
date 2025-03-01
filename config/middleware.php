<?php

declare(strict_types=1);

use middlewares\Admin;
use middlewares\Authentication;
use middlewares\Guest;

return [
    'auth'  => Authentication::class,
    'guest' => Guest::class,
    'admin' => Admin::class,
];
