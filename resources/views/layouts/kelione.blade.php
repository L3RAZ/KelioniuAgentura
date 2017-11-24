@extends('layouts.layout')

@section('content')
<div class="container">
    <div class="row">
        <h2 class="col-12 col-sm-12 col-md-12 col-xs-12">Kelionės pasiūlymas</h2>
    </div>
<div class="row">
<table>
    <tr>
        <td>Kelionės kryptis: </td>
        <td>{{ $kelione->valstybe}}</td>
    </tr>
    <tr>
        <td>Miestas: </td>
        <td>{{ $kelione->miesto_pav}}</td>
    </tr>
    <tr>
        <td>Kaina: </td>
        <td>{{ $kelione->kaina}}</td>
    </tr>
    <tr>
        <td>Trasportas: </td>
        <td>{{ $kelione->transporto_priemones}}</td>
    </tr>
    <tr>
        <td>Aprašymas: </td>
        <td>{{ $kelione->aprasymas}}</td>
    </tr>
    <tr>
        <td>Kelionės tipas: </td>
        <td>{{ $kelione->kel_tipas}}</td>
    </tr>
</table>
</div>
<div class="row">
    <!-- sita paskui paslepti nuo neprisijungusiu vartotoju-->
    <div class="col-4 col-sm-4 col-md-4 col-xs-4 col-md-offset-4"><input type="button" name="uzsakyti" value="Užsakyti" class="button"></div>
</div>
</div>
@endsection