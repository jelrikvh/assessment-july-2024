<?php

declare(strict_types=1);

namespace App\Domain;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(ByCar::class)]
class ByCarTest extends TestCase
{
    public function testItKnowsItsOwnName(): void
    {
        $this->assertSame('car', (string) new ByCar());
    }

    public function testItReturnsTheCorrectAmount(): void
    {
        $this->assertSame(10, (new ByCar())->compensationPerKilometerForDistancePerDayInCents(42));
    }
}
