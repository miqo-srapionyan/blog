<?php

declare(strict_types=1);

namespace core;

class Session
{
    public static function get($name)
    {
        if (isset($_SESSION[$name])) {
            return $_SESSION[$name];
        }

        return '';
    }

    public static function set($name, $value)
    {
        $_SESSION[$name] = $value;
    }

    public function __call($name, $arguments)
    {
        if ($name === 'get') {
            call_user_func(array('Session', 'get'));
        }
        if ($name === 'set') {
            call_user_func(array('Session', 'set'), $arguments);
        }
    }

    public static function __callStatic($name, $arguments)
    {
        if ($name === 'get') {
            call_user_func(array('Session', 'get'));
        }
        if ($name === 'set') {
            call_user_func(array('Session', 'set'), $arguments);
        }
    }
}