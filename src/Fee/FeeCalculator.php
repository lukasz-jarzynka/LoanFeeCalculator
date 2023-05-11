<?php

declare(strict_types=1);

namespace App\Fee;

use App\Loan\LoanProposal;
use App\Rounding\FeeRoundingStrategyInterface;

class FeeCalculator implements FeeCalculatorInterface
{
    private FeeInterpolator $interpolator;
    private FeeRoundingStrategyInterface $roundingStrategy;
    public const FEE_STRUCTURE = [
        1000 => 50,
        2000 => 90,
        3000 => 90,
        4000 => 115,
        5000 => 100,
        6000 => 120,
        7000 => 140,
        8000 => 160,
        9000 => 180,
        10000 => 200,
        11000 => 220,
        12000 => 240,
        13000 => 260,
        14000 => 280,
        15000 => 300,
        16000 => 320,
        17000 => 340,
        18000 => 360,
        19000 => 380,
        20000 => 400,
    ];

    /**
     * @param FeeInterpolator $feeInterpolator
     * @param FeeRoundingStrategyInterface $roundingStrategy
     */
    public function __construct(FeeInterpolator $feeInterpolator, FeeRoundingStrategyInterface $roundingStrategy)
    {
        $this->interpolator = $feeInterpolator;
        $this->roundingStrategy = $roundingStrategy;
    }

    /**
     * @param LoanProposal $loanProposal
     * @return float
     */
    public function calculate(LoanProposal $loanProposal): float
    {
        $loanAmount = $loanProposal->getAmount();

        if ($loanAmount < 0) {
            throw new \InvalidArgumentException('Loan amount cannot be negative.');
        }

        $feeAmount = $this->interpolator->interpolate($loanAmount, self::FEE_STRUCTURE);
        $roundedFeeAmount = $this->roundingStrategy->round($feeAmount);

        return $roundedFeeAmount;
    }

    public function calculateWithCustomFeeStructure(LoanProposal $loanProposal, array $feeStructure): float
    {
        if (empty($feeStructure)) {
            throw new \RuntimeException('Fee structure cannot be empty.');
        }

        foreach ($feeStructure as $key => $value) {
            if (!is_int($key)) {
                throw new \InvalidArgumentException('Fee structure keys must be integers.');
            }
        }

        $loanAmount = $loanProposal->getAmount();
        $feeAmount = $this->interpolator->interpolate($loanAmount, $feeStructure);
        $roundedFeeAmount = $this->roundingStrategy->round($feeAmount);

        return $roundedFeeAmount;
    }
}