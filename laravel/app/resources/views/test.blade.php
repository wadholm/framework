<?php
use Mack\Dice\Dice;
use Mack\Dice\GraphicalDice;
use Mack\Dice\DiceHand;

$hand = new DiceHand();

$hand->addDice(new GraphicalDice());
$hand->addDice(new GraphicalDice());

$data["graphicalDice"] = [];


$hand->roll();

$playerSum = $hand->sum();

$data["graphicalDice"] = $hand->getGraphics();

?>

<h1>{{ $header }}</h1>

<p>{{ $message }}</p>

<p>Summa: {{ $playerSum }}</p>


<p class="dice-utf8">
@foreach ($data["graphicalDice"] as $dice)
    <i class="dice">{{ $dice }}</i>
    <i class="{{ $dice }}"></i>
@endforeach

