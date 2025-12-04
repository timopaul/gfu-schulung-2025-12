<?php

declare(strict_types=1);

namespace App;

use App\Contracts\VehicleInterface;

abstract class Vehicle implements VehicleInterface
{
    private int $wheels;

    private string $color;

    private string $brand;

    public function __construct(string $brand, string $color)
    {
        $this->setBrand($brand);
        $this->setColor($color);
    }

    // Visibility must be public to satisfy the VehicleInterface
    abstract public function getType(): string;

    protected function getColor(): string
    {
        return $this->color;
    }

    private function setColor(string $color): void
    {
        $this->color = $color;
    }

    protected function getBrand(): string
    {
        return $this->brand;
    }

    protected function setBrand(string $brand): void
    {
        $this->brand = $brand;
    }

    public function getWheels(): int
    {
        return $this->wheels;
    }

    public function setWheels(int $wheels): void
    {
        $this->wheels = $wheels;
    }

    public function info(): string
    {
        return 'Mein ' . $this->getType() . ' ist ein ' . $this->getColor() . 'er ' . $this->getBrand() . ' mit ' . $this->getWheels() . ' Rädern';
    }
}
