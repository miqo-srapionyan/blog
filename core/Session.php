<?php

declare(strict_types=1);

namespace core;

/**
 * Session Management Class
 *
 * This class provides utility methods for handling session data, including
 * retrieving, setting, and checking the existence of session variables.
 */
class Session
{
    /**
     * Retrieves a session value by key.
     *
     * @param string $key The session key.
     * @return mixed The session value or an empty string if not set.
     */
    public static function get(string $key): mixed
    {
        return $_SESSION[$key] ?? '';
    }

    /**
     * Sets a session value.
     *
     * @param string $key The session key.
     * @param string|null $value The value to store in the session.
     * @return void
     */
    public static function set(string $key, ?string $value): void
    {
        $_SESSION[$key] = $value;
    }

    /**
     * Checks if a session key exists and is not empty.
     *
     * @param string $key The session key to check.
     * @return bool True if the session key exists and has a value, false otherwise.
     */
    public static function has(string $key): bool
    {
        return !empty($_SESSION[$key]);
    }
}
