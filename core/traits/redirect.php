<?php

declare(strict_types=1);

namespace core\traits;

use function header;

/**
 * Redirect Trait
 *
 * This trait provides a method to handle HTTP redirects.
 */
trait Redirect
{
    /**
     * Redirects the user to a specified URL.
     *
     * @param string $to The destination URL.
     *
     * @return void
     */
    protected function redirect(string $to): void
    {
        header("Location: $to");
        exit(); // Ensure script execution stops after redirect
    }
}
