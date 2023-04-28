<?php

declare(strict_types=1);

namespace PragmaGoTech\Interview\Model;

interface FeeRoundingStrategyInterface
{
    /**
     * @param float $totalAmount
     * @return float
     */
    public function round(float $totalAmount): float;
}