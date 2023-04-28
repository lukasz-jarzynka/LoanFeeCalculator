<?php

declare(strict_types=1);

require_once 'vendor/autoload.php';

use PragmaGoTech\Interview\Model\FeeCalculator;
use PragmaGoTech\Interview\Model\FeeInterpolator;
use PragmaGoTech\Interview\Model\LoanProposal;
use PragmaGoTech\Interview\Model\MultipleOfFiveRounding;

$interpolator = new FeeInterpolator();
$roundingStrategy = new MultipleOfFiveRounding();
$calculator = new FeeCalculator($interpolator, $roundingStrategy);

$loanProposal = new LoanProposal(6500);

$fee = $calculator->calculate($loanProposal);

echo "Kwota kredytu: {$loanProposal->getAmount()} PLN\n";
echo "Opłata: {$fee} PLN\n";