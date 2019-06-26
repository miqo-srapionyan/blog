<?php
    return [
        'auth' => \middlewares\Authentication::class,
        'guest' => \middlewares\Guest::class,
        'admin' => \middlewares\Admin::class,
    ];
?>