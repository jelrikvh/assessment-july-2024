<?php

declare(strict_types=1);

namespace App\Domain;

use DateTimeImmutable;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(TravelCompensationPerMonth::class)]
class TravelCompensationPerMonthTest extends TestCase
{
    public function testItKnowsItsBasicData(): void
    {
        $compensation = new TravelCompensationPerMonth(
            new EmployeeName('Some Employee'),
            new Month(7, 2024),
            new ByPublicTransit(),
            0.6,
            2,
        );

        $this->assertSame('Some Employee', (string) $compensation->employeeName());
        $this->assertEquals(new DateTimeImmutable('2024-07-01'), $compensation->paymentDate());
        $this->assertInstanceOf(ByPublicTransit::class, $compensation->transportMode());
    }

    public function testItCorrectlyCalculatesTheTravelDistancePerMonth(): void
    {
        // Arrange
        $compensation = new TravelCompensationPerMonth(
            new EmployeeName('Some Employee'),
            new Month(6, 2024),
            new ByPublicTransit(),
            0.6,
            2,
        );

        // Act + Assert
        $this->assertSame(48.0, $compensation->totalDistanceInKilometers());
    }

    public function testItCorrectlyCalculatesTheCompensationAmount(): void
    {
        // Arrange
        $compensation = new TravelCompensationPerMonth(
            new EmployeeName('Some Employee'),
            new Month(6, 2024),
            new ByPublicTransit(),
            0.6,
            2,
        );

        // Act + Assert
        $this->assertSame(1200.0, $compensation->compensationAmountInCents());
    }
}
