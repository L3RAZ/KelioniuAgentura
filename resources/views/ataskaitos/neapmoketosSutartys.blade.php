@extends('layouts.layout')

@section('content')

<div class="container">

    <h2 class="col-12 col-sm-12 col-md-12 col-xs-12">Neapmokėtos sutartys</h2>

    <div class="row">
        <table id="kelionesTable">
            <tr class="tableRow">
                <th>Sutarties nr.</th>
                <th>Klientas</th>
                <th>Užsakymo kaina</th>
            </tr>
            @foreach($ataskaita as $row)
                <tr class="tableRow">
                    <td>{{$row['nr']}}</td>
                    <td>{{$row['name']}} {{$row['surname']}}</td>
                    <td>{{$row['bendra_kaina']}} &euro;</td>
                </tr>
            @endforeach
        </table>
    </div>
</div>

@endsection