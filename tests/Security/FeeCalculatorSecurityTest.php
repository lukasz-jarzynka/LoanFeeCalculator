<?php

namespace App\Tests\Security;

use App\Fee\FeeCalculator;
use App\Fee\FeeInterpolator;
use App\Loan\LoanProposal;
use App\Rounding\MultipleOfFiveRounding;
use PHPUnit\Framework\TestCase;

class FeeCalculatorSecurityTest extends TestCase
{
    private FeeCalculator $feeCalculator;

    protected function setUp(): void
    {
        $interpolator = new FeeInterpolator();
        $roundingStrategy = new MultipleOfFiveRounding();
        $this->feeCalculator = new FeeCalculator($interpolator, $roundingStrategy);
    }

    public function testNegativeLoanAmount()
    {
        $loanProposal = new LoanProposal(-1000);

        $this->expectException(\InvalidArgumentException::class);

        $this->feeCalculator->calculate($loanProposal);
    }

    public function testInvalidLoanAmountDataType()
    {
        $this->expectException(\TypeError::class);

        $loanProposal = new LoanProposal('invalid_amount');
        $this->feeCalculator->calculate($loanProposal);
    }

    public function testMissingFeeStructure()
    {
        $loanProposal = new LoanProposal(1000);
        $emptyFeeStructure = [];

        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('Fee structure cannot be empty.');

        $this->feeCalculator->calculateWithCustomFeeStructure($loanProposal, $emptyFeeStructure);
    }

    public function testInvalidFeeStructure()
    {
        $loanProposal = new LoanProposal(1000);
        $invalidFeeStructure = [
            'invalid_key' => 50,
        ];

        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Fee structure keys must be integers.');

        $this->feeCalculator->calculateWithCustomFeeStructure($loanProposal, $invalidFeeStructure);
    }
}