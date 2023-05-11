<?php

declare(strict_types=1);

namespace App\Loan;

class LoanProposal
{
    private float $amount;

    public function __construct(float $amount)
    {
        $this->amount = $amount;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

}