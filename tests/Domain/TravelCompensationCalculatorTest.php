<?php

declare(strict_types=1);

namespace App\Domain;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(TravelCompensationCalculator::class)]
class TravelCompensationCalculatorTest extends TestCase
{
    public function testItReturnsAllMonths(): void
    {
        // Arrange
        $calculator = new TravelCompensationCalculator();
        $employee = new Employee(new EmployeeName('Employee'), new ByBike(), 1, 10);

        // Act
        $result = $calculator->monthlyPerYearForEmployee(2024, $employee);

        // Assert
        $this->assertCount(12, $result);

        $this->assertSame('2024-01-01', $result[0]->paymentDate()->format('Y-m-d'));
        $this->assertSame('Employee', (string) $result[0]->employeeName());
        $this->assertInstanceOf(ByBike::class, $result[0]->transportMode());

        $this->assertSame('2024-02-05', $result[1]->paymentDate()->format('Y-m-d'));
        $this->assertSame('Employee', (string) $result[1]->employeeName());
        $this->assertInstanceOf(ByBike::class, $result[1]->transportMode());

        $this->assertSame('2024-03-04', $result[2]->paymentDate()->format('Y-m-d'));
        $this->assertSame('Employee', (string) $result[2]->employeeName());
        $this->assertInstanceOf(ByBike::class, $result[2]->transportMode());

        $this->assertSame('2024-04-01', $result[3]->paymentDate()->format('Y-m-d'));
        $this->assertSame('Employee', (string) $result[3]->employeeName());
        $this->assertInstanceOf(ByBike::class, $result[3]->transportMode());

        $this->assertSame('2024-05-06', $result[4]->paymentDate()->format('Y-m-d'));
        $this->assertSame('Employee', (string) $result[4]->employeeName());
        $this->assertInstanceOf(ByBike::class, $result[4]->transportMode());

        $this->assertSame('2024-06-03', $result[5]->paymentDate()->format('Y-m-d'));
        $this->assertSame('Employee', (string) $result[5]->employeeName());
        $this->assertInstanceOf(ByBike::class, $result[5]->transportMode());

        $this->assertSame('2024-07-01', $result[6]->paymentDate()->format('Y-m-d'));
        $this->assertSame('Employee', (string) $result[6]->employeeName());
        $this->assertInstanceOf(ByBike::class, $result[6]->transportMode());

        $this->assertSame('2024-08-05', $result[7]->paymentDate()->format('Y-m-d'));
        $this->assertSame('Employee', (string) $result[7]->employeeName());
        $this->assertInstanceOf(ByBike::class, $result[7]->transportMode());

        $this->assertSame('2024-09-02', $result[8]->paymentDate()->format('Y-m-d'));
        $this->assertSame('Employee', (string) $result[8]->employeeName());
        $this->assertInstanceOf(ByBike::class, $result[8]->transportMode());

        $this->assertSame('2024-10-07', $result[9]->paymentDate()->format('Y-m-d'));
        $this->assertSame('Employee', (string) $result[9]->employeeName());
        $this->assertInstanceOf(ByBike::class, $result[9]->transportMode());

        $this->assertSame('2024-11-04', $result[10]->paymentDate()->format('Y-m-d'));
        $this->assertSame('Employee', (string) $result[10]->employeeName());
        $this->assertInstanceOf(ByBike::class, $result[10]->transportMode());

        $this->assertSame('2024-12-02', $result[11]->paymentDate()->format('Y-m-d'));
        $this->assertSame('Employee', (string) $result[11]->employeeName());
        $this->assertInstanceOf(ByBike::class, $result[11]->transportMode());
    }
}
