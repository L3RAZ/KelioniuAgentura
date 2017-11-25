@extends('layouts.layout')
@section('content')
<div class="container">
@if(count($korteles)>0)
<h2>Jūsų pridėtos kortelės</h2>
<table style="width: 100%" class="table table-hover table-bordered">
    <thead>
        <tr><td>Sąskaitos numeris</td><td>Bankas</td><td>Kortelės numeris</td><td>Galiojimo data</td><td>CVV</td><td>Kortelės tipas</td><td>Šalinti</td></tr>
    </thead>
    <tbody>
    @foreach($korteles as $kortele)
    <tr>
        <td>{{ $kortele->saskaitos_nr }}</td>
        <td>{{ $kortele->banko_pavadinimas }}</td>
        <td>{{ $kortele->korteles_nr }}</td>
        <td>{{ $kortele->galiojimo_data }}</td>
        <td>{{ $kortele->cvv }}</td>
        <td>{{ $kortele->korteles_tipas }}</td>
        <td><form method="POST" action="/korteles/{{$kortele->id}}">
            {{ method_field('DELETE') }}
            {{ csrf_field() }}
            <button type="submit" class="btn btn-danger">Šalinti</button>
            </form>
        </td>
                       
    </tr>
    @endforeach
    </tbody>
</table>
<div class="row">
<div class="col-md-12 " href="/korteles/prideti/nauja"><button onClick="window.location.href='/korteles/prideti/nauja'" type="button"  class="button">Pridėti naują kortelę</button></div>
</div>
@else
<div class="row">
    <h1 style="text-align: center;">Jūs šiuo metu neturite pridėtų kortelių</h1>
    <br>
</div>
<div class="row">
<div class="col-md-12 " href="/korteles/prideti/nauja"><button onClick="window.location.href='/korteles/prideti/nauja'" type="button"  class="button">Pridėti dabar!</button></div>
</div>
@endif
</div>
@endsection