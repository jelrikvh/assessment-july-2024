<?php

declare(strict_types=1);

namespace App\Infrastructure;

use App\Domain\ByPublicTransit;
use App\Domain\EmployeeName;
use App\Domain\Month;
use App\Domain\TravelCompensationPerMonth;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(TravelCompensationPerMonthToCsv::class)]
class TravelCompensationPerMonthToCsvTest extends TestCase
{
    public function testItTransformsToCsv(): void
    {
        // Arrange
        $transformer = new TravelCompensationPerMonthToCsv();

        $compensation = new TravelCompensationPerMonth(
            new EmployeeName('Test Employee'),
            new Month(7, 2024),
            new ByPublicTransit(),
            0.6,
            3,
        );

        // Act
        $result = $transformer->transform($compensation);

        // Assert
        self::assertSame(
            '"Test Employee","public transit","82.8","20.7","2024-07-01"',
            $result,
        );
    }
}
