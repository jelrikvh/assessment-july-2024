<?php

declare(strict_types=1);

namespace App\Infrastructure;

use App\Domain\TravelCompensationPerMonth;

use function implode;

final class TravelCompensationPerMonthToCsv
{
    public function transform(TravelCompensationPerMonth $compensation): string
    {
        return sprintf('"%s"', implode(
            '","',
            [
                (string) $compensation->employeeName(),
                (string) $compensation->transportMode(),
                (string) $compensation->totalDistanceInKilometers(),
                (string) round($compensation->compensationAmountInCents() / 100, 2),
                $compensation->paymentDate()->format('Y-m-d'),
            ]
        ));
    }
}
