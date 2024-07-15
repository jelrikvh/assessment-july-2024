<?php

declare(strict_types=1);

namespace App\Domain;

final class ByPublicTransit implements TransportMode
{
    public function compensationPerKilometerForDistancePerDayInCents(int $distancePerDayInKilometers): int
    {
        return 25;
    }

    public function __toString(): string
    {
        return 'public transit';
    }
}
