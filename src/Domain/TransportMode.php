<?php

declare(strict_types=1);

namespace App\Domain;

interface TransportMode
{
    public function compensationPerKilometerForDistancePerDayInCents(int $distancePerDayInKilometers): int;
    public function __toString(): string;
}
