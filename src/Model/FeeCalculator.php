<?php

declare(strict_types=1);

namespace PragmaGoTech\Interview\Model;

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
     * @param FeeInterpolator $interpolator
     * @param FeeRoundingStrategyInterface $roundingStrategy
     */
    public function __construct(FeeInterpolator $interpolator, FeeRoundingStrategyInterface $roundingStrategy)
    {
        $this->interpolator = $interpolator;
        $this->roundingStrategy = $roundingStrategy;
    }

    /**
     * @param LoanProposal $loanProposal
     * @return float
     */
    public function calculate(LoanProposal $loanProposal): float
    {
        $loanAmount = $loanProposal->getAmount();
        $feeAmount = $this->interpolator->interpolate($loanAmount, self::FEE_STRUCTURE);
        $totalAmount = $loanAmount + $feeAmount;
        $roundedTotalAmount = $this->roundingStrategy->round($totalAmount);

        return $roundedTotalAmount - $loanAmount;
    }
}