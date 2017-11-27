@extends('layouts.layout')

@section('content')

<div class="container">

    <h2 class="col-12 col-sm-12 col-md-12 col-xs-12">Vidutinės kelionių kainos pagal kelionės šalį</h2>

    <div class="row">
        <table id="kelionesTable">
            <tr class="tableRow">
                <th>Šalis</th>
                <th>Vidutinė kelionės kaina</th>
            </tr>
            @foreach($ataskaita as $row)
                <tr class="tableRow">
                    <td>{{$row['valstybe']}}</td>
                    <td>{{$row['kaina']}} &euro;</td>
                </tr>
            @endforeach
        </table>
    </div>
</div>

@endsection