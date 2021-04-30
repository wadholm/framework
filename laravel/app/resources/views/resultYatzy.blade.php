<?php

$home = url("/yatzy/home");


$header = $header ?? null;

$result = $request->session()->get('result', null);
$score = $request->session()->get('score', null);

$totalScore = $totalScore ?? null;
$bonusScore = $bonusScore ?? null;
$bonus = $bonus ?? null;

?>

<h1>{{ $header }}</h1>

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
