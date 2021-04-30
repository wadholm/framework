<?php

$home = url("/game21/home");

$header = $header ?? null;

$message = $request->session()->get('result', null);
// $message = $_SESSION["result"] ?? null;

$playerSum = $request->session()->get('playerSum', null);
$dataSum = $request->session()->get('dataSum', null);
// $playerSum = $_SESSION["playerSum"] ?? null;
// $dataSum = $_SESSION["dataSum"] ?? null;

$playerWins = $request->session()->get('playerWins', null);
$dataWins = $request->session()->get('dataWins', null);
// $playerWins = $_SESSION["playerWins"] ?? null;
// $dataWins = $_SESSION["dataWins"] ?? null;


?>

<h1>{{ $header }}</h1>

<p>{{ $message }}</p>

<p>You rolled {{ $playerSum }}.</p>

@if ($dataSum != null)
<p>Computer rolled {{ $dataSum }}.</p>
@endif

<p>
<button class="play">
    <a class="play" href="{{ $home }}">Play again?</a>
</button>
</p>

<div class="scoreboard">
<h4>Score board.</h4>
<p>Player: {{ $playerWins }}</p>
<p>Computer: {{ $dataWins }}</p>
</div>
