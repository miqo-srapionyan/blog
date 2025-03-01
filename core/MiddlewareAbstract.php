<?php

declare(strict_types=1);

namespace core;

abstract class MiddlewareAbstract
{
    abstract public function run($url);
}
