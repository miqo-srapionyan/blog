<?php

namespace core;

class Router
{

    private $routes = [];
    private $current_url;

    function __construct()
    {
        $this->routes = require "config/routes.php";
        $this->current_url = trim($_SERVER['REQUEST_URI'], '/');

        foreach ($this->routes as $route => $params) {
            if (!preg_match('/^(\/[a-zA-Z0-9_]*)*(\/\{[a-zA-Z0-9_]+\??\})*$/', $route, $matches)) {
                die('Wrong route name - ' . $route);
            }
        }

    }

    public function urlLoad()
    {
        $exists = false;
        foreach ($this->routes as $route => $params) {
            $route = trim($route, '/');
            $route_uries = explode('/', $route);
            $url_uries = explode('/', $this->current_url);

            $count_not_required_params = substr_count($route, '?}');
            if (!(count($url_uries) <= count($route_uries) && count($url_uries) >= count($route_uries) - $count_not_required_params)) {
                continue;
            }
            $exists = true;
            $url_check = true;
            $action_params = [];

            for ($i = 0; $i < count($url_uries); $i++) {
                if (!preg_match('/^\{([a-zA-Z0-9_]+)\??\}$/', $route_uries[$i], $matches)) {
                    if ($route_uries[$i] != $url_uries[$i]) {
                        $url_check = false;
                        break;
                    }
                } else {
                    $action_params[$matches[1]] = $url_uries[$i];
                }
            }

            if ($url_check) {
                if (!isset($params['controller'])) {
                    die('Please add controller');
                }
                $path = "controllers\\" . $params['controller'];

                if (class_exists($path)) {
                    if (!isset($params['action'])) {
                        die('Please add action');
                    }
                    if (method_exists($path, $params['action'])) {
                        $controller = new $path;
                        $action = $params['action'];
                        if (isset($params['middleware'])) {
                            $this->checkMiddlewares($params['middleware'], $route);
                        }
                        try {
                            $controller->$action($action_params);
                        } catch (\Exception $e) {
                            $controller->$action();
                        }
                        break;
                    } else {
                        die('No such action exists.');
                    }
                } else {
                    die('No such controller exists.');
                }
            }
        }
        if (!$exists) {
            die('There is no such route.');
        }
    }

    public function checkMiddlewares($middlewares, $route)
    {
        $all_middlewares = require('config/middleware.php');
        $middlewares = explode('|', $middlewares);
        foreach ($middlewares as $middleware) {
            if (isset($all_middlewares[$middleware])) {
                $classname = $all_middlewares[$middleware];
                (new $classname())->run($route);
            } else {

            }
        }
    }
}
