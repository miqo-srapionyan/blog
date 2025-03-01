<?php

declare(strict_types=1);

namespace core;

class View
{
    private array $params;
    private string $path;
    public string $layout;

    function __construct()
    {
        $this->layout = 'layouts/default';
    }

    public function render($path, $params = [])
    {
        $path = "views/$path.php";

        if (!file_exists($path)) {
            die('No such view file '.$path);
        }
        $this->params = $params;
        $this->path = $path;
        $this->real_render();

        return;
    }

    private function real_render()
    {
        foreach ($this->params as $key => $value) {
            $$key = $value;
        }

        unset($this->params);

        $view = $this->path;
        if (!file_exists('views/'.$this->layout.'.php')) {
            die('No such view layout file '.$this->layout.'.php');
        }
        $session = new Session;
        require 'views/'.$this->layout.'.php';
    }
}
