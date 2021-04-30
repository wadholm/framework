<?php

$favicon = url("/../resources/img/favicon.ico");
$style = url("/../resources/css/style.css");

$home = url('/');
$session = url('/session');
$test = url('/test');
$game21 = url("/game21/home");
$yatzy = url("/yatzy/home");

?>

<!doctype html>
<html>
    <meta charset="utf-8">
    <title>{{ $title ?? "No title" }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ $favicon }}">
    <link rel="stylesheet" type="text/css" href="{{ $style }}">
</head>

<body>

<header>
    <nav>
        <a class="active" href="{{ $home }}">Home</a>
        <a href="{{ $session }}">Session</a>
        <a href="{{ $test }}">Test</a>
        <a href="{{ $game21 }}">21</a>
        <a href="{{ $yatzy }}">Yatzy</a>
    </nav>
</header>
<main>