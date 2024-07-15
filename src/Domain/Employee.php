<?php

declare(strict_types=1);

namespace App\Domain;

final class Employee
{
    public function __construct(
        private readonly EmployeeName $name,
        private readonly TransportMode $transportMode,
        private readonly float $fractionOfWorkWeek,
        private readonly int $oneWayDistanceInKilometers,
    ) {
    }

    public function fractionOfWorkWeek(): float
    {
        return $this->fractionOfWorkWeek;
    }

    public function name(): EmployeeName
    {
        return $this->name;
    }

    public function oneWayDistanceInKilometers(): int
    {
        return $this->oneWayDistanceInKilometers;
    }

    public function transportMode(): TransportMode
    {
        return $this->transportMode;
    }
}
