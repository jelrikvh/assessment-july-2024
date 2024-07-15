<?php

declare(strict_types=1);

namespace App\Domain;

final class ByCar implements TransportMode
{
    public function compensationPerKilometerForDistancePerDayInCents(int $distancePerDayInKilometers): int
    {
        return 10;
    }

    public function __toString(): string
    {
        return 'car';
    }
}
