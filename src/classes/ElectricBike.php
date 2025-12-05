<?php

declare(strict_types=1);

namespace App;

use App\Contracts\ElectricInterface;
use App\Traits\ElectricTrait;

class ElectricBike extends Bike implements ElectricInterface
{
    use ElectricTrait;

    public function getType(): string
    {
        return 'Elektrofahrrad';
    }

    public function info(): string
    {
        return parent::info() . ' und ' . $this->electricInfo();
    }
}
