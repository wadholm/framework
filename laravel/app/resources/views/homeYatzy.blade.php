<?php

$destroy = url("/yatzy/destroy");
$play = url("/yatzy/play");

$numberOfDices = 5;

?>

<h1>{{ $header }}</h1>

<form method="POST" action="{{ $play }}">
@csrf
<input type="hidden" id="start" name="start" value="start">
<input type="hidden" id="dices" name="dices" value="{{ $numberOfDices }}">
<button name="start" type="submit">Start game</button>

</form>

<p>
<button class="reset">
    <a class="reset" href="{{ $destroy }}">Reset score</a>
</button>
</p>
