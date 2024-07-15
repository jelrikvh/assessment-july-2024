<?php

declare(strict_types=1);

namespace App\Domain;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(Employee::class)]
#[CoversClass(EmployeeName::class)]
class EmployeeTest extends TestCase
{
    public function testItCanExist(): void
    {
        $employee = new Employee(
            new EmployeeName('Some Employee Name'),
            new ByBike(),
            0.42,
            42,
        );

        $this->assertSame('Some Employee Name', (string) $employee->name());
        $this->assertInstanceOf(ByBike::class, $employee->transportMode());
        $this->assertSame(0.42, $employee->fractionOfWorkWeek());
        $this->assertSame(42, $employee->oneWayDistanceInKilometers());
    }
}
