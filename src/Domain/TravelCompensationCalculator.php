<?php

declare(strict_types=1);

namespace App\Domain;

final class TravelCompensationCalculator
{
    /** @var array<int> */
    private const array MONTHS = [1,2,3,4,5,6,7,8,9,10,11,12];

    /** @return array<TravelCompensationPerMonth> */
    public function monthlyPerYearForEmployee(int $year, Employee $employee): array
    {
        $monthlyCompensations = [];

        foreach (self::MONTHS as $month) {
            $monthlyCompensations[] = new TravelCompensationPerMonth(
                $employee->name(),
                new Month($month, $year),
                $employee->transportMode(),
                $employee->fractionOfWorkWeek(),
                $employee->oneWayDistanceInKilometers(),
            );
        }

        return $monthlyCompensations;
    }
}
