<?php

declare(strict_types=1);

namespace App\Tests\Integration;

use App\Rounding\MultipleOfFiveRounding;
use PHPUnit\Framework\TestCase;

class MultipleOfFiveRoundingIntegrationTest extends TestCase
{
    public function feesDataProvider(): array
    {
        return [
            [128.50, 130],
            [382.30, 385],
            [200, 200],
            [202.50, 205],
            [419.99, 420],
        ];
    }

    /**
     * @dataProvider feesDataProvider
     */
    public function testRoundWithVariousFees(float $fee, float $expectedRoundedFee): void
    {
        $roundingStrategy = new MultipleOfFiveRounding();

        $roundedFee = $roundingStrategy->round($fee);
        $this->assertEquals($expectedRoundedFee, $roundedFee);
    }
}