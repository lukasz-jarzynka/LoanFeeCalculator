<?php

declare(strict_types=1);

namespace App\Tests\Integration;

use App\Fee\FeeCalculator;
use App\Fee\FeeInterpolator;
use App\Loan\LoanProposal;
use App\Rounding\MultipleOfFiveRounding;
use PHPUnit\Framework\TestCase;

class FeeCalculatorIntegrationTest extends TestCase
{
    public function testFeeCalculatorIntegration(): void
    {
        // Create instances of needed objects
        $interpolator = new FeeInterpolator();
        $roundingStrategy = new MultipleOfFiveRounding();
        $calculator = new FeeCalculator($interpolator, $roundingStrategy);

        // Prepare test data
        $loanAmount = 6500;
        $expectedFee = 130;

        // Create a loan proposal based on the loan amount
        $loanProposal = new LoanProposal($loanAmount);

        // Calculate the fee using the fee calculator
        $fee = $calculator->calculate($loanProposal);

        // Compare the expected fee with the calculated fee
        $this->assertEquals($expectedFee, $fee);
    }
}