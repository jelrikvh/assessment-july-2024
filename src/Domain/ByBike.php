<?php

declare(strict_types=1);

namespace App\Domain;

final class ByBike implements TransportMode
{
    public function compensationPerKilometerForDistancePerDayInCents(int $distancePerDayInKilometers): int
    {
        if ($distancePerDayInKilometers < 5) {
            return 50;
        }

        return 100;
    }

    public function __toString(): string
    {
        return 'bike';
    }
}
