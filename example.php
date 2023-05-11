<?php

declare(strict_types=1);

require_once 'vendor/autoload.php';

use App\Fee\FeeCalculator;
use App\Fee\FeeInterpolator;
use App\Loan\LoanProposal;
use App\Rounding\MultipleOfFiveRounding;

$interpolator = new FeeInterpolator();
$roundingStrategy = new MultipleOfFiveRounding();
$calculator = new FeeCalculator($interpolator, $roundingStrategy);

$loanProposal = new LoanProposal(6500);

$fee = $calculator->calculate($loanProposal);

echo "Kwota kredytu: {$loanProposal->getAmount()} PLN\n";
echo "Opłata: {$fee} PLN\n";