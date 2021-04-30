<?php

$play = url("/game21/play");

$header = $header ?? null;
$message = $message ?? null;
$numberOfDices = $numberOfDices ?? null;
$playerSum = $playerSum ?? null;

$graphicalDice = $graphicalDice ?? null;

?>



<h1>{{  $header  }}</h1>

<p>{{  $message }}</p>

<p>Sum: {{ $playerSum }}</p>

<p class="dice-utf8">

@if ($graphicalDice != null)
    @foreach ($graphicalDice as $value)
    <i class="dice">{{ $value }}</i>
    @endforeach
@endif


</p>



<form method="POST" action="{{ $play }}">
@csrf
<input type="hidden" id="dices" name="dices" value="{{ $numberOfDices }}">
<button name="roll" type="submit" value="roll">Roll dices</button>
<button name="roll" type="submit" value="stop">Stop</button>
</form>

