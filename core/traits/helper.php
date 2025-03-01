<?php

declare(strict_types=1);

namespace core\traits;

trait Helper
{
    protected function redirect($to)
    {
        header("Location: $to");
    }
}