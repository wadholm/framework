<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Mack\Game\PlayGame21;

class Game21Controller extends Controller
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

        return view('layout.home21', [
            'title' => 'Play 21',
            'header' => 'Play 21',
            'message' => 'Choose number of dices:',
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
        return redirect('game21/home');
    }

        /**
     * Play the game.
     *
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Routing\Redirector
     */
    public function play(Request $request)
    {
        $game = new PlayGame21();
        $game->startGame($request);
        $numberOfDices  = $game->getNumberOfDices($request);

        $data = [
            "header" => "Game21",
            "title" => "Game21",
            "message" => "You're playing with " . $numberOfDices . " dices.",
            "request" => $request,
            "numberOfDices" => $numberOfDices,
            "playerSum" => $request->session()->get('playerSum'),
        ];

        $roll = $request->input("roll", null);
        // $roll = $_POST["roll"] ?? null;
        $res = $game->playGame($roll, $request);

        $data["graphicalDice"] = $res["graphicalDice"] ?? 0;
        $data["playerSum"] = $request->session()->get('playerSum');
        // $data["playerSum"] = $_SESSION["playerSum"];

        if ($request->session()->get('playerWinner') == true || $request->session()->get('dataWinner') == true) {
            // $_SESSION["result"] = $res["result"] ?? null;
            $request->session()->put("result", $res["result"] ?? null);

            return redirect('game21/result');
        }

        return view('layout.play21', $data);
    }

    /**
     * Display the result page.
     *
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function result(Request $request)
    {
        // $_SESSION["playerWins"] = $_SESSION["playerWins"] ?? 0;
        // $_SESSION["dataWins"] = $_SESSION["dataWins"] ?? 0;
        // $_SESSION["playerWinner"] = false;
        // $_SESSION["dataWinner"] = false;
        // $_SESSION["result"] = null;

        return view('layout.result21', [
            'title' => 'Result',
            'header' => 'Result',
            'request' => $request
        ]);
    }
}
