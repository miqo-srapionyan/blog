<?php

namespace core\traits;

trait Helper
{
    protected function redirect($to)
    {
        header("Location: $to");
        return;
    }
}

?>