<?php

namespace PragmaGoTech\Interview\tests;

use PHPUnit\Framework\TestCase;
use PragmaGoTech\Interview\Model\MultipleOfFiveRounding;

class MultipleOfFiveRoundingTest extends TestCase
{
    public function testRound()
    {
        $roundingStrategy = new MultipleOfFiveRounding();

        $roundedFee1 = $roundingStrategy->round(6500);
        $this->assertEquals(6500, $roundedFee1);

        $roundedFee2 = $roundingStrategy->round(6499);
        $this->assertEquals(6500, $roundedFee2);

        $roundedFee3 = $roundingStrategy->round(6502);
        $this->assertEquals(6505, $roundedFee3);
    }
}