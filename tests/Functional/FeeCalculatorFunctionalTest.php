<?php

declare(strict_types=1);

namespace App\Tests\Functional;

use App\Fee\FeeCalculator;
use App\Fee\FeeInterpolator;
use App\Loan\LoanProposal;
use App\Rounding\FeeRoundingStrategyInterface;
use PHPUnit\Framework\TestCase;

class FeeCalculatorFunctionalTest extends TestCase
{
    private FeeCalculator $feeCalculator;

    protected function setUp(): void
    {
        $feeInterpolator = new FeeInterpolator();
        $roundingStrategy = $this->createMock(FeeRoundingStrategyInterface::class);
        $roundingStrategy->method('round')->willReturnArgument(0);

        $this->feeCalculator = new FeeCalculator($feeInterpolator, $roundingStrategy);
    }

    public function testCalculateFeeForSmallLoan()
    {
        $loanProposal = new LoanProposal(1500);
        $fee = $this->feeCalculator->calculate($loanProposal);

        $this->assertEquals(70, $fee);
    }

    public function testCalculateFeeForMediumLoan()
    {
        $loanProposal = new LoanProposal(7500);
        $fee = $this->feeCalculator->calculate($loanProposal);

        $this->assertEquals(150, $fee);
    }

    public function testCalculateFeeForLargeLoan()
    {
        $loanProposal = new LoanProposal(18000);
        $fee = $this->feeCalculator->calculate($loanProposal);

        $this->assertEquals(360, $fee);
    }
}