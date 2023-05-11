<?php

declare(strict_types=1);

namespace App\Rounding;

interface FeeRoundingStrategyInterface
{
    /**
     * @param float $totalAmount
     * @return float
     */
    public function round(float $totalAmount): float;
}