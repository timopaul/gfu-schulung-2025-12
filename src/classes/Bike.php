<?php

declare(strict_types=1);

namespace App;

class Bike extends Vehicle
{
    public function __construct(string $brand, string $color)
    {
        parent::__construct($brand, $color);

        $this->setWheels(2);
    }

    public function getType(): string
    {
        return 'Fahrrad';
    }
}
