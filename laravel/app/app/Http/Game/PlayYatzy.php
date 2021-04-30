<?php

declare(strict_types=1);

namespace Mack\Game;

use Mack\Dice\DiceHand;
use Mack\Helper\Helper;

use function Mos\Functions\{
    addDices,
    printHistogram
};

// use function Mos\Functions\{
//     destroySession,
//     redirectTo,
//     renderView,
//     renderTwigView,
//     sendResponse,
//     url
// };


/**
 * Class PlayYatzy.
 */
class PlayYatzy
{
    public $numberOfDices = 5;
    public $checkedBoxes;
    public $res;
    public $bonus = false;
    public $dices = [
        "dice-1",
        "dice-2",
        "dice-3",
        "dice-4",
        "dice-5"
    ];
    public $rounds = [
        "round-1",
        "round-2",
        "round-3",
        "round-4",
        "round-5",
        "round-6"
    ];

    public function startGame($request)
    {
        // if (isset($_POST["start"])) {
        //     $_SESSION["result"] = null;
        //     $_SESSION["score"] = null;
        //     $this->resetSessionRounds();
        // }
        if ($request->has('start')) {
            session(['result' => null]);
            session(['score' => null]);
            $this->resetSessionRounds($request);
        }
    }

    public function getFirstNumberOfDices()
    {
        $this->numberOfDices = 5;
        return $this->numberOfDices;
    }

    public function getNumberOfDices($request)
    {
        $this->numberOfDices = (int)$request->input('dices') ?? 0;
        return $this->numberOfDices;
    }

    public function getCheckedBoxes($request)
    {
        foreach ($this->dices as $dice) {

            if ($request->has($dice) && $request->input($dice) == $request->input("round")) {
                $this->checkedBoxes++;
            }
            // if (isset($_POST[$dice]) && $_POST[$dice] == $_POST["round"]) {
            //     $this->checkedBoxes++;
            // }
        }
        return $this->checkedBoxes;
    }

    public function getSessionRounds($request)
    {
        foreach ($this->rounds as $round) {
            // $_SESSION[$round] = $_SESSION[$round] ?? 0;
            $request->session()->put($round, session($round) ?? 0);
        }
    }

    public function resetSessionRounds($request)
    {
        foreach ($this->rounds as $round) {
            $_SESSION[$round] = 0;
            $request->session()->put($round, 0);
        }
    }

    public function addScore($round, $request)
    {
        for ($i = 0; $i < $this->checkedBoxes; $i++) {
            $request->session()->push('score', $round);
            // $_SESSION["score"][] = $round;
        }
    }

    public function getMessage($round, $roll)
    {
        $this->res["message"] = "Select dices to save, then roll again.";

        if ($roll == 3) {
            $this->res["message"] = "Select dices to save.";
        } elseif ($roll == 4) {
            $this->res["message"] = "You rolled " . session("round-$round") . " dices with the value of " . $round . ".";
        }
        return $this->res["message"];
    }

    public function playGame($rollDices, $round, $roll, $request)
    {
        if ($rollDices != null && $rollDices == "rolldices") {
            $this->getCheckedBoxes($request);
            $this->numberOfDices = $this->getNumberOfDices($request) - $this->checkedBoxes;
            $this->res = $this->rollDices($round, $roll, $request);
        }
        return $this->res;
    }

    public function rollDices($round, $roll, $request)
    {
        $this->res["round"] = $round;
        $this->res["roll"] = $roll;

        $diceHand = new DiceHand();
        if ($roll == 1) {
            $this->numberOfDices = $this->getFirstNumberOfDices();
        }
        $helper = new Helper();
        $diceHand = $helper->addDices($diceHand, $this->numberOfDices);
        $this->res["numberOfDices"] = $this->numberOfDices;

        if ($this->numberOfDices != 0) {
            $diceHand->roll();
        }

        // // $_SESSION[$round] = $_SESSION[$round] ?? 0;
        // $request->session()->put('round', session('round') ?? 0);

        $request->session()->put("round-$round", session("round-$round") + $this->checkedBoxes);
        // $_SESSION["round-$round"] = $_SESSION["round-$round"] + $this->checkedBoxes;

        if ((int)$request->input("round-$round") == 5) {
            $request->session()->put("yatzy", "You rolled Yatzy!!");
            // $_SESSION["yatzy"] = "You rolled Yatzy!!";
            $roll = 4;
        }

        $this->addScore($round, $request);

        $this->res["graphics2rolls"] = $diceHand->getGraphics2Rolls();
        $this->res["message"] = $this->getMessage($round, $roll);

        if ($roll == 4) {
            $this->res["round"] = $round + 1;
            $this->res["roll"] = 0;
            $this->res["graphics2rolls"] = null;
            if ($this->res["round"] > 6) {
                $helper = new Helper();
                $request->session()->put("result", $helper->printHistogram(session("score")));
                // $_SESSION["result"] = printHistogram(session("score"));
            }
        }
        return $this->res;
    }

    public function calculateTotalScore($score)
    {
        $this->res["totalScore"] = 0;
        if ($score != null) {
            foreach ($score as $value) {
                $this->res["totalScore"] += $value;
            }
        }
        return $this->res["totalScore"];
    }

    public function checkForBonus($request)
    {
        $bonusflag = 0;
        foreach ($this->rounds as $round) {
            if (session($round) >= 3) {
                $bonusflag += 1;
            }
        }
        if (isset($this->res["totalScore"]) && $this->res["totalScore"]  >= 63 && $bonusflag == 6) {
            $this->bonus = true;
        }
        return $this->bonus;
    }
}
