<?php

declare(strict_types=1);

namespace App\Domain;

use DateTimeImmutable;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

#[CoversClass(Month::class)]
class MonthTest extends TestCase
{
    public function testItReturnsTheFirstMondayOfTheMonthAsThePaymentDate(): void
    {
        // Arrange
        $january2024 = new Month(1, 2024);
        $february2024 = new Month(2, 2024);
        $march2024 = new Month(3, 2024);

        // Act + Assert
        $this->assertEquals(new DateTimeImmutable('2024-01-01'), $january2024->paymentDate());
        $this->assertEquals(new DateTimeImmutable('2024-02-05'), $february2024->paymentDate());
        $this->assertEquals(new DateTimeImmutable('2024-03-04'), $march2024->paymentDate());
    }

    #[DataProvider('workDaysInMonths')]
    public function testNumberOfWorkDaysInMonth(int $month, int $year, int $expectedNumberOfWorkDays): void
    {
        // Arrange
        $month = new Month($month, $year);

        // Act
        $result = $month->numberOfWorkDaysInMonth();

        // Assert
        $this->assertSame($expectedNumberOfWorkDays, $result);
    }

    public static function workDaysInMonths(): array
    {
        return [
            'February 2023' => [2, 2023, 20],
            'February 2024' => [2, 2024, 21],
            'June 2024' => [6, 2024, 20],
            'July 2024' => [7, 2024, 23],
            'August 2024' => [8, 2024, 22]
        ];
    }
}
