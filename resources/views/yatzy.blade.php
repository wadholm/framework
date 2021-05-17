<?php

$play = url("/yatzy/play");

$header = $header ?? null;
$message = $message ?? null;
$yatzy = session("yatzy", null);
$diceHand = $diceHand ?? null;
$numberOfDices = $numberOfDices ?? null;
$graphicalDice = $graphicalDice ?? null;
$roll = $roll ?? null;
$round = $round ?? 1;
$graphics2rolls = $graphics2rolls ?? null;


?>

<div class="yatzy-div">

<h1>{{  $header  }}</h1>

<p>{{ $yatzy }}</p>

<p>{{  $message }}</p>

<p>Throw {{ $roll }}</p>
<p>Roll for {{ $round }}</p>

</div>
<form class="dice-form" method="POST" action="{{ $play }}">
@csrf
@if ($graphics2rolls != null)
@php
    $i = 0;
@endphp

@foreach ($graphics2rolls as $rolled)
        <input class="checkbox" type="checkbox" id="dice-{{ $i += 1 }}" name="dice-{{ $i }}" value="{{ Arr::get($rolled, 'value') }}">
        <label class="checkbox-graphics" for="dice-{{ $i }}">{{ Arr::get($rolled, 'graphic') }}</label><br>
@endforeach
@endif

<input type="hidden" id="dices" name="dices" value="{{ $numberOfDices }}">
<input type="hidden" id="roll" name="roll" value="{{ $roll + 1 }}">
<input type="hidden" id="round" name="round" value="{{ $round }}">
@if ($roll < 3)
<button name="rolldices" type="submit" value="rolldices">Roll dices</button>

@elseif ($roll == 3)
<button name="rolldices" type="submit" value="rolldices">Next</button>
@endif
</form>
