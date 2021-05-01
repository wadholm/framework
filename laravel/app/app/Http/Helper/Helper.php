<?php

declare(strict_types=1);

namespace Mack\Helper;

use Mack\Dice\GraphicalDice;

class Helper
{
    /**
     * Add dices.
     *
     * @return object
     */
    public function addDices($diceHand, $numberDices): object
    {
        for ($i = 0; $i < $numberDices; $i++) {
            $diceHand->addDice(new GraphicalDice());
        }
        return $diceHand;
    }


/**
 * Print histogram.
 *
 * @return string
 */
    public function printHistogram($score): string
    {
        $stars1 = "";
        $stars2 = "";
        $stars3 = "";
        $stars4 = "";
        $stars5 = "";
        $stars6 = "";

        foreach ($score as $value) {
            switch ($value) {
                case 1:
                    $stars1 = $stars1 . "*";
                    break;
                case 2:
                    $stars2 = $stars2 . "*";
                    break;
                case 3:
                    $stars3 = $stars3 . "*";
                    break;
                case 4:
                    $stars4 = $stars4 . "*";
                    break;
                case 5:
                    $stars5 = $stars5 . "*";
                    break;
                case 6:
                    $stars6 = $stars6 . "*";
                    break;
            }
        }
        // Print the histogram from the
        // $this->histogramValues[]
        return <<<EOT
    1: $stars1 <br>
    2: $stars2 <br>
    3: $stars3 <br>
    4: $stars4 <br>
    5: $stars5 <br>
    6: $stars6 <br>
    EOT;
    }
}
