<?php

declare(strict_types=1);

namespace App\Traits;

trait ElectricTrait
{
    private int $batteryCapacity;

    public function setBatteryCapacity(int $capacity): void
    {
        $this->batteryCapacity = $capacity;
    }

    public function getBatteryCapacity(): int
    {
        return $this->batteryCapacity;
    }

    private function electricInfo(): string
    {
        return ' mit einer Batteriekapazität von ' . $this->getBatteryCapacity() . ' kWh';
    }
}

