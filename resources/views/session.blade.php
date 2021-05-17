<?php

$url = url("/session/destroy");

echo <<<EOD
<h1>Session details</h1>
<p>Here are some details on the session. Reload this page to see the counter increment itself.</p>
<p>You may <a class="session" href="$url">destroy the session</a> if you like, good for dealing
with trouble.</p>
EOD;

$data = $request->session()->all();

var_dump($data);

if ($request->session()->missing('counter')) {
    session(['counter' => 0]);
}

$request->session()->increment('counter');
// $request->session()->put('key','value');

$counter = $request->session()->get('counter');

?>

<p>{{ $counter }}</p>

