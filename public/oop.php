<?php

declare(strict_types=1);

require_once __DIR__ . '/../src/autoload.php';

use App\Car;
use App\Bus;
use App\Bike;
use App\ElectricCar;
use App\ElectricBike;

// Instanzen (gleiches Verhalten wie vorher)
$bmw = new Car('BMW', 'schwarz');
$bmw->setSeats(4);

$volvo = new Car('Volvo', 'blau');

$ford = new Car('Ford', 'weiß');

$skoda = new ElectricCar('Skoda', 'grün');
$skoda->setBatteryCapacity(55);

$diamant = new Bike('Diamant', 'rot');

$baboe = new Bike('Baboe', 'grau');
$baboe->setWheels(3);

$vwBus = new Bus('VW', 'gelb');

$cube = new ElectricBike('Cube', 'orange');
$cube->setBatteryCapacity(10);

echo '<pre>$bmw: ' . print_r($bmw, true) . '</pre>';
echo '<pre>$volvo: ' . print_r($volvo, true) . '</pre>';
echo '<pre>$ford: ' . print_r($ford, true) . '</pre>';
echo '<pre>$skoda: ' . print_r($skoda, true) . '</pre>';
echo '<pre>$vwBus: ' . print_r($vwBus, true) . '</pre>';

echo '<br />';

echo '<pre>$diamant: ' . print_r($diamant, true) . '</pre>';
echo '<pre>$baboe: ' . print_r($baboe, true) . '</pre>';
echo '<pre>$cube: ' . print_r($cube, true) . '</pre>';

echo $bmw->info() . '<br />';
echo $volvo->info() . '<br />';
echo $ford->info() . '<br />';
echo $skoda->info() . '<br />';
echo $vwBus->info() . '<br />';

echo '<br />';

echo $diamant->info() . '<br />';
echo $baboe->info() . '<br />';
echo $cube->info() . '<br />';
