<?php

declare(strict_types=1);

namespace PragmaGoTech\Interview\tests;

use PHPUnit\Framework\TestCase;
use PragmaGoTech\Interview\Model\FeeInterpolator;
use PragmaGoTech\Interview\Model\FeeCalculator;

class FeeInterpolatorTest extends TestCase
{
    public function testInterpolate()
    {
        $feeStructure = FeeCalculator::FEE_STRUCTURE;

        $interpolator = new FeeInterpolator();

        $interpolatedFee1 = $interpolator->interpolate(6500, $feeStructure);
        $this->assertEquals(130, $interpolatedFee1);

        $interpolatedFee2 = $interpolator->interpolate(19250, $feeStructure);
        $this->assertEquals(385, $interpolatedFee2);
    }
}