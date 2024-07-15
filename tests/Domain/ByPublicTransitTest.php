<?php

declare(strict_types=1);

namespace App\Domain;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(ByPublicTransit::class)]
class ByPublicTransitTest extends TestCase
{
    public function testItKnowsItsOwnName(): void
    {
        $this->assertSame('public transit', (string) new ByPublicTransit());
    }

    public function testItReturnsTheCorrectAmountForShortDistances(): void
    {
        $this->assertSame(25, (new ByPublicTransit())->compensationPerKilometerForDistancePerDayInCents(42));
    }
}
