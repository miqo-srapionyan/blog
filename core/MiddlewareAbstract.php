<?php

namespace core;

abstract class MiddlewareAbstract
{
    abstract public function run($url);
}

?>