<?php

declare(strict_types=1);

namespace App\Fee;

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

        // Check if the loan amount is less than the minimum amount in the fee structure
        if ($loanAmount < min(array_keys($feeStructure))) {
            return $feeStructure[min(array_keys($feeStructure))];
        }

        // Check if the loan amount is greater than the maximum amount in the fee structure
        if ($loanAmount > max(array_keys($feeStructure))) {
            $keys = array_keys($feeStructure);
            $penultimateKey = $keys[count($keys) - 2];
            $lastKey = $keys[count($keys) - 1];
            $penultimateFee = $feeStructure[$penultimateKey];
            $lastFee = $feeStructure[$lastKey];
            return $lastFee + (($loanAmount - $lastKey) * ($lastFee - $penultimateFee)) / ($lastKey - $penultimateKey);
        }

        $lowerBoundFee = $feeStructure[$lowerBound];
        $upperBoundFee = $feeStructure[$upperBound];

        // Calculation of the interpolated fee based on the lower and upper bounds and the value of the loan
        return $lowerBoundFee + (($loanAmount - $lowerBound) * ($upperBoundFee - $lowerBoundFee)) / ($upperBound - $lowerBound);
    }
}