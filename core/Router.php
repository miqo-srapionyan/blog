<?php

declare(strict_types=1);

namespace core;

use function trim;
use function preg_match;
use function explode;
use function substr_count;
use function count;
use function class_exists;
use function method_exists;

/**
 * Router class handles request routing by matching URLs to controllers and actions.
 * It supports dynamic route parameters and middleware execution.
 */
class Router
{
    /**
     * User-defined routes loaded from the configuration file.
     *
     * @var array
     */
    private array $routes;

    /**
     * The current request URL.
     *
     * @var string
     */
    private string $currentUrl;

    /**
     * Router constructor.
     * Loads the routes from the configuration file and validates them.
     */
    function __construct()
    {
        $this->routes = require "config/routes.php";
        $this->currentUrl = trim($_SERVER['REQUEST_URI'], '/');

        foreach ($this->routes as $route => $params) {
            // This regex validates a route pattern:
            if (!preg_match('/^(\/[a-zA-Z0-9_]*)*(\/\{[a-zA-Z0-9_]+\??\})*$/', $route)) {
                die('Wrong route name - '.$route);
            }
        }
    }

    /**
     * Processes the current URL, matches it against defined routes,
     * and calls the corresponding controller action if found.
     *
     * @return void
     */
    public function urlLoad(): void
    {
        $exists = false;
        foreach ($this->routes as $route => $params) {
            $route = trim($route, '/');
            $routeUris = explode('/', $route);
            $urlUris = explode('/', $this->currentUrl);

            // Count optional parameters in the route
            $countNotRequiredParams = substr_count($route, '?}');
            if (!(count($urlUris) <= count($routeUris) && count($urlUris) >= count($routeUris) - $countNotRequiredParams)) {
                continue;
            }

            $exists = true;
            $urlCheck = true;
            $actionParams = [];

            // Match URL segments with route parameters
            for ($i = 0; $i < count($urlUris); $i++) {
                // Validates if the string is a dynamic route parameter in `{}` format,
                if (!preg_match('/^\{([a-zA-Z0-9_]+)\??\}$/', $routeUris[$i], $matches)) {
                    if ($routeUris[$i] != $urlUris[$i]) {
                        $urlCheck = false;
                        break;
                    }
                } else {
                    $actionParams[$matches[1]] = $urlUris[$i];
                }
            }

            // If route matches, proceed to execute the corresponding controller action
            if ($urlCheck) {
                if (!isset($params['controller'])) {
                    die('Please add controller');
                }

                $path = "controllers\\".$params['controller'];

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
                            $controller->$action($actionParams);
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

        // If no matching route is found, terminate with an error
        if (!$exists) {
            die('There is no such route.');
        }
    }

    /**
     * Executes middleware functions associated with a specific route.
     *
     * @param string $middlewares The middleware(s) to be executed, separated by '|'.
     * @param string $route       The route for which the middleware is applied.
     *
     * @return void
     */
    public function checkMiddlewares(string $middlewares, string $route): void
    {
        $allMiddlewares = require('config/middleware.php');
        $middlewares = explode('|', $middlewares);

        foreach ($middlewares as $middleware) {
            if (isset($allMiddlewares[$middleware])) {
                $classname = $allMiddlewares[$middleware];
                (new $classname())->run($route);
            }
        }
    }
}
