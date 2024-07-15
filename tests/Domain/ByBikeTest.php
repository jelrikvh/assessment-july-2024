<?php

declare(strict_types=1);

namespace App\Domain;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(ByBike::class)]
class ByBikeTest extends TestCase
{
    public function testItKnowsItsOwnName(): void
    {
        $this->assertSame('bike', (string) new ByBike());
    }

    public function testItReturnsTheCorrectAmountForShortDistances(): void
    {
        $this->assertSame(50, (new ByBike())->compensationPerKilometerForDistancePerDayInCents(4));
    }

    public function testItReturnsTheCorrectAmountForLongerDistances(): void
    {
        $this->assertSame(100, (new ByBike())->compensationPerKilometerForDistancePerDayInCents(5));
    }
}
