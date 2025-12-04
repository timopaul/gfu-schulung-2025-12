<?php

declare(strict_types=1);

namespace App;

class Bus extends Car
{
    public function __construct(string $brand, string $color)
    {
        parent::__construct($brand, $color);

        $this->setWheels(6);
        $this->setSeats(20);
    }

    public function getType(): string
    {
        return 'Bus';
    }
}
