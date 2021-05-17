<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Mack\Game\PlayYatzy;
use Mack\Helper\Helper;
use Mack\Highscore\HighscoreHandler;
use App\Models\Highscore;

class YatzyController extends Controller
{
    /**
     * Display the home page.
     *
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function home(Request $request)
    {
        // $_SESSION["playerWins"] = $_SESSION["playerWins"] ?? 0;
        // $_SESSION["dataWins"] = $_SESSION["dataWins"] ?? 0;
        // $_SESSION["playerWinner"] = false;
        // $_SESSION["dataWinner"] = false;
        // $_SESSION["result"] = null;

        return view('layout.homeYatzy', [
            'title' => 'Yatzy',
            'header' => 'Yatzy',
            'request' => $request
        ]);
    }

    /**
     * Destroy the session to reset score.
     *
     *
     * @return \Illuminate\Routing\Redirector
     */
    public function destroy(Request $request)
    {
        $request->session()->flush();
        return redirect('yatzy/home');
    }

    /**
     * Play the game.
     *
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Routing\Redirector
     */
    public function play(Request $request)
    {
        $game = new PlayYatzy();
        $game->startGame($request);

        $data = [
            "header" => "Yatzy",
            "title" => "Yatzy",
            "message" => "Play Yatzy.",
            "request" => $request,
            "numberOfDices" => $request->input("dices", 0),
            "rollDices" => $request->input("rolldices", null),
            "roll" => $request->input("roll", 0),
            "round" => $request->input("round", 1)
        ];


        $request->session()->put('result', session('result') ?? null);
        $request->session()->put('score', session('score') ?? null);

        // $_SESSION["result"] = $_SESSION["result"] ?? null;
        // $_SESSION["score"] = $_SESSION["score"] ?? null;


        $game->getSessionRounds($request);

        $res = $game->playGame($data["rollDices"], $data["round"], $data["roll"], $request);

        $data["message"] = $res["message"] ?? null;
        $data["graphics2rolls"] = $res["graphics2rolls"] ?? null;

        if (isset($res["numberOfDices"])) {
            $data["numberOfDices"] = $res["numberOfDices"];
        }

        if (isset($res["round"])) {
            $data["round"] = $res["round"];
        }

        if (isset($res["roll"])) {
            $data["roll"] = $res["roll"];
        }

        if ($request->session()->has('result')) {
            $helper = new Helper();
            $request->session()->put("result", $helper->printHistogram(session("score")));

            return redirect('yatzy/result');
        }

        return view('layout.yatzy', $data);
    }

    /**
     * Display the result page.
     *
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function result(Request $request)
    {
        $data = [
            "title" => "Yatzy",
            "header" => "Yatzy",
            "request" => $request,
            "bonus" => false,
            "score" => session("score", null),
            "totalScore" => 0,
            "bonusScore" => 50,
            "highscore" => 0,
            "newHighscore" => false
        ];

        $game = new PlayYatzy();
        $handler = new Highscore();
        $data["highscore"] = $handler->getHighscore();

        $data["totalScore"] = $game->calculateTotalScore($data["score"]);
        $data["bonus"] = $game->checkForBonus();

        if ($data["totalScore"] >= $data["highscore"]) {
            $data["newHighscore"] = true;
        }

        return view('layout.resultYatzy', $data);
    }

    /**
     * Add new highscore.
     *
     *
     * @return \Illuminate\Routing\Redirector
     */
    public function addHighscore(Request $request)
    {
        $name = $request->input('name');
        $score = $request->input('score');

        $handler = new HighscoreHandler();
        $handler->addHighscore($name, $score);

        return redirect('yatzy/highscore');
    }

    /**
     * Display the highscore page.
     *
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function highscore()
    {
        $data = [
            "title" => "Yatzy High Score",
            "header" => "Yatzy High Score",
            "message" => "Presenting the High Score for Yatzy Game",
        ];

        $handler = new Highscore();
        $data["result"] = $handler->presentHighscore();

        return view('layout.highscore', $data);
    }
}
