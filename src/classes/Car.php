<?php

declare(strict_types=1);

namespace App;

class Car extends Vehicle
{
    private int $seats = 5;

    public function __construct(string $brand, string $color)
    {
        parent::__construct($brand, $color);

        $this->setWheels(4);
    }

    public function setSeats(int $seats): void
    {
        $this->seats = $seats;
    }

    public function getSeats(): int
    {
        return $this->seats;
    }

    // Visibility changed to public to implement VehicleInterface
    public function getType(): string
    {
        return 'Auto';
    }

    public function info(): string
    {
        return parent::info() . ' und ' . $this->getSeats() . ' Sitzen';
    }
}
