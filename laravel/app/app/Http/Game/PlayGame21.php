<?php

declare(strict_types=1);

namespace Mack\Game;

use Mack\Dice\DiceHand;
use Mack\Helper\Helper;

// use function Mack\Functions\{
//     addDices
// };

// use function Mos\Functions\{
//     destroySession,
//     redirectTo,
//     renderView,
//     renderTwigView,
//     sendResponse,
//     url
// };


/**
 * Class PlayGame21.
 */
class PlayGame21
{
    public $numberOfDices = 2;
    public $res;

    public function startGame($request)
    {
        // if (isset($_POST["start"])) {
        //     $_SESSION["playerSum"] = 0;
        //     $_SESSION["dataSum"] = 0;
        // }
        if ($request->has('start')) {
            session(['playerSum' => 0]);
            session(['dataSum' => 0]);
        }
    }

    public function getNumberOfDices($request)
    {
        return $this->numberOfDices = (int)$request->input('dices');
    }

    public function playGame($roll, $request)
    {
        if ($roll != null && $roll == "roll") {
            $value = $request->session()->get('playerSum');
            $this->res = $this->rollPlayer($value, $request);

            $request->session()->put('playerSum', $this->res["playerSum"] ?? 0);
            // $_SESSION["playerSum"] = $this->res["playerSum"] ?? 0;
        } elseif ($roll != null && $roll == "stop") {
            $value = $request->session()->get('playerSum');
            $this->res = $this->rollComputer($value, $request);

            $request->session()->put('dataSum', $this->res["dataSum"] ?? 0);
            // $_SESSION["dataSum"] = $this->res["dataSum"] ?? 0;
        }
        return $this->res;
    }

    public function rollPlayer($playerSum, $request, $cheat = 0)
    {
        $diceHand = new DiceHand();
        $helper = new Helper();
        $diceHand = $helper->addDices($diceHand, $this->numberOfDices);
        $diceHand->roll();

        $playerSum += $diceHand->sum();
        $this->res["playerSum"] = $playerSum;
        $this->res["graphicalDice"] = $diceHand->getGraphics();
        if ((int)$playerSum == 21 || $cheat == 21) {
            $request->session()->increment('playerWins');
            $request->session()->put('playerWinner', true);
            // $_SESSION["playerWins"] += 1;
            // $_SESSION["playerWinner"] = true;
            $this->res["result"] = "Congratulations! You won, computer lost.";
        } elseif ((int)$playerSum > 21) {
            $request->session()->increment('dataWins');
            $request->session()->put('dataWinner', true);

            // $_SESSION["dataWins"] += 1;
            // $_SESSION["dataWinner"] = true;
            $this->res["result"] = "You lost, computer wins.";
        }
        return $this->res;
    }

    public function rollComputer($playerSum, $request)
    {
        $diceHand = new DiceHand();
        $helper = new Helper();
        $diceHand = $helper->addDices($diceHand, $this->numberOfDices);

        $dataSum = 0;
        while ($dataSum < $playerSum) {
            $diceHand->roll();
            $dataSum += $diceHand->sum();
        }

        if ($dataSum <= 21 && $dataSum >= $playerSum) {
            $request->session()->increment('dataWins');
            $request->session()->put('dataWinner', true);
            // $_SESSION["dataWins"] += 1;
            // $_SESSION["dataWinner"] = true;
            $this->res["result"] = "You lost, computer wins.";
            $this->res["dataSum"] = $dataSum;
            return $this->res;
        }
        $request->session()->increment('playerWins');
        $request->session()->put('playerWinner', true);
        // $_SESSION["playerWins"] += 1;
        // $_SESSION["playerWinner"] = true;
        $this->res["result"] = "Congratulations! You won, computer lost.";

        $this->res["dataSum"] = $dataSum;
        return $this->res;
    }
}
