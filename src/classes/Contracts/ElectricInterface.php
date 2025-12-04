<?php

declare(strict_types=1);

namespace App\Contracts;

interface ElectricInterface
{
    public function setBatteryCapacity(int $capacity): void;

    public function getBatteryCapacity(): int;
}

