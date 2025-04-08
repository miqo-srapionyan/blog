<?php

declare(strict_types=1);

namespace core;

/**
 * BaseMiddleware Abstract Class
 *
 * This abstract class defines the structure for middleware classes.
 * All middleware classes must implement the `run` method to handle requests.
 */
abstract class BaseMiddleware
{
    /**
     * Executes the middleware logic for a given URL.
     *
     * @param string $url The current request URL.
     *
     * @return void
     */
    abstract public function run(string $url): void;
}

