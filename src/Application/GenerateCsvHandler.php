<?php

declare(strict_types=1);

namespace App\Application;

use App\Domain\Employees;
use App\Domain\TravelCompensationCalculator;
use App\Domain\TravelCompensationPerMonth;
use App\Infrastructure\TravelCompensationPerMonthToCsv;

final readonly class GenerateCsvHandler
{
    public function __construct(
        private Employees $employees,
        private TravelCompensationCalculator $calculator,
        private TravelCompensationPerMonthToCsv $toCsv
    ) {
    }

    public function handle(GenerateCsv $command): string
    {
        // Gather data
        $travelCompensationsPerMonth = [];
        $employees = $this->employees->all();

        foreach ($employees as $employee) {
            $travelCompensationsPerMonth = array_merge(
                $travelCompensationsPerMonth,
                $this->calculator->monthlyPerYearForEmployee(
                    (int) date('Y'),
                    $employee,
                )
            );
        }

        // Return csv
        return implode(PHP_EOL, array_map(
            fn (TravelCompensationPerMonth $compensation) => $this->toCsv->transform($compensation),
            $travelCompensationsPerMonth,
        ));
    }
}
