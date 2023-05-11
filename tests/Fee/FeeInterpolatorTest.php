<?php

declare(strict_types=1);

namespace App\Tests\Fee;

use App\Fee\FeeCalculator;
use App\Fee\FeeInterpolator;

use PHPUnit\Framework\TestCase;

/**
 * @dataProvider interpolationDataProvider
 */
class FeeInterpolatorTest extends TestCase
{
    public function interpolationDataProvider(): array
    {
        return [
            [6500, 130],
            [19250, 385],
        ];
    }

    /**
     * @dataProvider interpolationDataProvider
     */
    public function testInterpolate(float $loanAmount, float $expectedInterpolatedFee): void
    {
        $feeStructure = FeeCalculator::FEE_STRUCTURE;
        $interpolator = new FeeInterpolator();

        $interpolatedFee = $interpolator->interpolate($loanAmount, $feeStructure);
        $this->assertEquals($expectedInterpolatedFee, $interpolatedFee);
    }
}