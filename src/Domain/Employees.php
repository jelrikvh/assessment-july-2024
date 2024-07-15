<?php

declare(strict_types=1);

namespace App\Domain;

interface Employees
{
    /** @return array<Employee> */
    public function all(): array;
}
