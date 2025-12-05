<?php

namespace App\Traits;

trait IsSingleton
{
    private static self $_instance;

    public static function getInstance(): self
    {
        return self::$_instance ??= new self();
    }
}
