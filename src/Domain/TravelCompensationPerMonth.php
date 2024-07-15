<?php

declare(strict_types=1);

namespace App\Domain;

use DateTimeImmutable;

final readonly class TravelCompensationPerMonth
{
    public function __construct(
        private EmployeeName $employeeName,
        private Month $month,
        private TransportMode $transportMode,
        private float $fractionOfWorkWeek,
        private int $oneWayDistanceInKilometers,
    ) {
    }

    public function compensationAmountInCents(): float
    {
        return $this->transportMode->compensationPerKilometerForDistancePerDayInCents($this->distancePerDay()) * $this->totalDistanceInKilometers();
    }

    public function employeeName(): EmployeeName
    {
        return $this->employeeName;
    }

    public function paymentDate(): DateTimeImmutable
    {
        return $this->month->paymentDate();
    }

    public function totalDistanceInKilometers(): float
    {
        return $this->month->numberOfWorkDaysInMonth() * $this->fractionOfWorkWeek * $this->distancePerDay();
    }

    public function transportMode(): TransportMode
    {
        return $this->transportMode;
    }

    private function distancePerDay(): int
    {
        return $this->oneWayDistanceInKilometers * 2;
    }
}
