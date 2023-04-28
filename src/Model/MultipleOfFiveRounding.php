<?php

declare(strict_types=1);

namespace PragmaGoTech\Interview\Model;

class MultipleOfFiveRounding implements FeeRoundingStrategyInterface
{
    /**
     * @param float $totalAmount
     * @return float
     */
    public function round(float $totalAmount): float
    {
        return ceil($totalAmount / 5) * 5;
    }
}