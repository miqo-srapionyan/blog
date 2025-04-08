<?php

declare(strict_types=1);

namespace core;

use core\traits\Redirect;

class Controller
{
    use Redirect;

    protected View $view;
    protected array $post;

    function __construct()
    {
        $this->view = new View;

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $this->post = $_POST;
        }
    }
}