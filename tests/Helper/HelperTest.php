<?php

declare(strict_types=1);

namespace Mack\Helper;

use PHPUnit\Framework\TestCase;
use Mack\Dice\DiceHand;

/**
 * Test cases for the Dice Helper-class.
 */
class HelperTest extends TestCase
{

    /**
     * Test the function adddices().
     *
     */
    public function testAddDices()
    {
        $helper = new Helper();
        $diceHand = new DiceHand();
        $numberOfDices = 3;
        $res = $helper->addDices($diceHand, $numberOfDices);
        $this->assertIsObject($res);
    }

    /**
     * Test the function printHistogram().
     *
     */
    public function testPrintHistogram()
    {
        $helper = new Helper();
        $score = [1, 2, 3, 4, 5, 6];
        $res = $helper->printHistogram($score);
        $this->assertIsString($res);
    }
}
