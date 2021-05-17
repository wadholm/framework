<?php

// use Mack\Dice\Dice;
// use Mack\Dice\DiceHand;
// use function Mos\Functions\url;

$destroy = url("/game21/destroy");
$play = url("/game21/play");
// $header = $header ?? null;
// $message = $message ?? null;
$playerWins = $request->session()->get('playerWins', 0);
$dataWins = $request->session()->get('dataWins', 0);

// nollställ, flyttat från controllern
$request->session()->put("playerWinner", false);
$request->session()->put("dataWinner", false);
$request->session()->put("result", null);

// $playerWins = $_SESSION["playerWins"] ?? 0;
// $dataWins = $_SESSION["dataWins"] ?? 0;

// $die = new Dice();
// $diceHand = new DiceHand();

// $die->roll();
// $diceHand->roll();

?>

<h1>{{ $header }}</h1>




<form method="POST" action="{{ $play }}">
@csrf
<label for="dices">{{ $message }}</label>
<input type="hidden" id="start" name="start" value="start">
<button name="dices" type="submit" value="1">1</button>
<button name="dices" type="submit" value="2">2</button>


</form>


<p><button class="reset"><a class="reset" href="{{ $destroy }}">Reset score</a></button></p>

<div class="scoreboard">
<h4>Score board.</h4>
<p>Player: {{ $playerWins }}</p>
<p>Computer: {{ $dataWins }}</p>
</div>
