<?php

declare(strict_types=1);

namespace PragmaGoTech\Interview\Model;

class FeeInterpolator
{
    /**
     * @param float $loanAmount
     * @param array $feeStructure
     * @return float
     */
    public function interpolate(float $loanAmount, array $feeStructure): float
    {
        $lowerBound = 0;
        $upperBound = 0;

        ksort($feeStructure);

        foreach ($feeStructure as $amount => $fee) {
            // Checking if the loan amount is less than or equal to the current element (If so, we set the upper limit to the current amount)
            if ($loanAmount <= $amount) {
                $upperBound = $amount;
                break;
            }
            // Otherwise, we set the lower bound to the current amount
            $lowerBound = $amount;
        }

        $lowerBoundFee = $feeStructure[$lowerBound];
        $upperBoundFee = $feeStructure[$upperBound];

        // Calculation of the interpolated fee based on the lower and upper bounds and the value of the loan
        return $lowerBoundFee + (($loanAmount - $lowerBound) * ($upperBoundFee - $lowerBoundFee)) / ($upperBound - $lowerBound);
    }
}