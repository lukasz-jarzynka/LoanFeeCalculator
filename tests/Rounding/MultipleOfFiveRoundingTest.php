<?php

namespace App\Tests\Rounding;

use App\Rounding\MultipleOfFiveRounding;
use PHPUnit\Framework\TestCase;

/**
 * @dataProvider roundingDataProvider
 */
class MultipleOfFiveRoundingTest extends TestCase
{
    public function roundingDataProvider(): array
    {
        return [
            [6500, 6500],
            [6499, 6500],
            [6502, 6505],
        ];
    }

    /**
     * @dataProvider roundingDataProvider
     */
    public function testRound(float $totalAmount, float $expectedRoundedAmount): void
    {
        $roundingStrategy = new MultipleOfFiveRounding();

        $roundedAmount = $roundingStrategy->round($totalAmount);
        $this->assertEquals($expectedRoundedAmount, $roundedAmount);
    }
}