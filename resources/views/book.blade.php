
<h1>{{ $header }}</h1>

<p>{{ $message }}</p>

@foreach ($result as $res)
<div class="books">
    <h3>{{ $res["titel"] }}</h3>
    <p>{{ $res["forfattare"] }}</p>
    <p>ISBN: {{ $res["isbn"] }}</p>
    <?php $image = url($res["bild"]);?>
    <img class="img" src="{{ $image }}" alt="{{ $res['titel'] }}">
</div>
@endforeach
