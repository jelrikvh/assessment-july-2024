<?php

declare(strict_types=1);

namespace App\Infrastructure;

use App\Domain\ByBike;
use App\Domain\ByCar;
use App\Domain\ByPublicTransit;
use App\Domain\Employee;
use App\Domain\EmployeeName;
use App\Domain\Employees;

/**
 * @codeCoverageIgnore
 */
final class InMemoryEmployees implements Employees
{
    public function all(): array
    {
        return [
            new Employee(new EmployeeName('Paul'), new ByCar(), 1, 60),
            new Employee(new EmployeeName('Martin'), new ByPublicTransit(), 0.8, 8),
            new Employee(new EmployeeName('Jeroen'), new ByBike(), 1, 9),
            new Employee(new EmployeeName('Tineke'), new ByBike(), 0.6, 4),
            new Employee(new EmployeeName('Arnout'), new ByPublicTransit(), 1, 23),
            new Employee(new EmployeeName('Matthijs'), new ByBike(), 0.9, 11),
            new Employee(new EmployeeName('Rens'), new ByCar(), 1, 12),
        ];
    }
}
