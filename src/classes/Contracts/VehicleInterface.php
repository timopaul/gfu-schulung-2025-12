<?php

declare(strict_types=1);

namespace App\Contracts;

interface VehicleInterface
{
    public function getType(): string;

    public function getWheels(): int;

    public function info(): string;
}
