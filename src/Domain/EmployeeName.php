<?php

declare(strict_types=1);

namespace App\Domain;

final readonly class EmployeeName
{
    public function __construct(private string $name)
    {
    }

    public function name(): string
    {
        return $this->name;
    }

    public function __toString(): string
    {
        return $this->name();
    }
}
