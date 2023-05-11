<?php

declare(strict_types=1);

namespace App\Fee;

use App\Loan\LoanProposal;

interface FeeCalculatorInterface
{
    /**
     * The calculated total fee.
     *
     * @param LoanProposal $loanProposal
     * @return float
     */
    public function calculate(LoanProposal $loanProposal): float;
}