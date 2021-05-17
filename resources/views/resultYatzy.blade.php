<?php

$home = url("/yatzy/home");
$showHighscore = url("/yatzy/highscore/add");


$header = $header ?? null;

$result = $request->session()->get('result', null);
$score = $request->session()->get('score', null);

$totalScore = $totalScore ?? null;
$bonusScore = $bonusScore ?? null;
$bonus = $bonus ?? null;

$highscore = $highscore ?? null;
$newHighscore = $newHighscore ?? null;

?>

<h1>{{ $header }}</h1>


@if ($newHighscore == true)
<p>Congratulations! You scored a new high score!</p>

<form method="POST" action="{{ $showHighscore }}">
@csrf
<input type="hidden" id="score" name="score" value="{{ $totalScore }}">
<label for="name">Name:</label>
  <input type="text" id="name" name="name" placeholder="Your name" maxlength="20" required><br>
<button name="addScore" type="submit">Add to High Score</button>

</form>
@endif

<p>
<button class="play">
    <a class="play" href="{{ $home }}">Play again?</a>
</button>
</p>

<div class="scoreboard">
<h4>Score board.</h4>
<p>{!! $result !!} </p>
<p>Sum: {{ $totalScore }} </p>
@if ($bonus == true)
    <p>Bonus: {{ $bonusScore }} </p>
    <p>{{ $totalScore += $bonusScore }}</p>
    <p>Total: {{ $totalScore }} </p>
@endif
</div>

