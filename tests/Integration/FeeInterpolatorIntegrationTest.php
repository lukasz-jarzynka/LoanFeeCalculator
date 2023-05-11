<?php

declare(strict_types=1);

namespace App\Tests\Integration;

use App\Fee\FeeCalculator;
use App\Fee\FeeInterpolator;
use PHPUnit\Framework\TestCase;

class FeeInterpolatorIntegrationTest extends TestCase
{
    /**
     * @dataProvider loanAmountDataProvider
     */
    public function testInterpolateWithVariousLoanAmounts(float $loanAmount, float $expectedFee): void
    {
        $feeStructure = FeeCalculator::FEE_STRUCTURE;
        $interpolator = new FeeInterpolator();

        $interpolatedFee = $interpolator->interpolate($loanAmount, $feeStructure);
        $this->assertEquals($expectedFee, $interpolatedFee);
    }

    public function loanAmountDataProvider(): array
    {
        return [
            [3000, 90],
            [10000, 200],
            [15000, 300],
            [21000, 420],
            [30000, 600],
        ];
    }
}