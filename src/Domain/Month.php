<?php

declare(strict_types=1);

namespace App\Domain;

use DateTimeImmutable;

use function date;
use function in_array;
use function sprintf;

final class Month
{
    private const array WORKDAYS = [1,2,3,4,5];

    public function __construct(
        private readonly int $month,
        private readonly int $year,
    ) {
    }

    public function numberOfWorkDaysInMonth(): int
    {
        // There are always 20 workdays in the first 28 days of a month: we only need to find out whether
        // days 29, 30, and 31 are workdays or not.
        $lastDayOfTheMonth = (new DateTimeImmutable(sprintf('%d-%d-01', $this->year, $this->month)))->format('t');

        if ($lastDayOfTheMonth < 29) {
            return 20;
        }

        $numberOfWorkDaysInLastDaysOfTheMonth = 0;
        for ($day = 29; $day <= $lastDayOfTheMonth; $day++) {
            if (!$this->isWorkDay($day)) {
                continue;
            }

            $numberOfWorkDaysInLastDaysOfTheMonth++;
        }

        return 20 + $numberOfWorkDaysInLastDaysOfTheMonth;
    }

    public function paymentDate(): DateTimeImmutable
    {
        return new DateTimeImmutable(sprintf('first monday of %d-%d', $this->year, $this->month));
    }

    private function isWorkDay(int $day): bool
    {
        return in_array(
            (new DateTimeImmutable(sprintf('%d-%d-%d', $this->year, $this->month, $day)))->format('N'),
            self::WORKDAYS
        );
    }
}
