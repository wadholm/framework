
<h1>{{ $header }}</h1>

<p>{{ $message }}</p>

<table>
  <tr>
    <th>Name</th>
    <th>Score</th>
  </tr>
  @foreach ($result as $res)
<tr>
    <td>{{ $res->name }}</td>
    <td>{{ $res->score }}</td>
  </tr>
@endforeach
</table>
