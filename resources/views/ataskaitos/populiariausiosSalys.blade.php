@extends('layouts.layout')

@section('content')

<div class="container">

    <h2 class="col-12 col-sm-12 col-md-12 col-xs-12">Populiariausios kelionių šalys pagal užsakymų skaičių</h2>

    <div class="row">
        <table id="kelionesTable">
            <tr class="tableRow">
                <th>Šalies pavadinimas</th>
                <th>Užsakymų skaičius</th>
            </tr>
            @foreach($ataskaita as $row)
                <tr class="tableRow">
                    <td>{{$row['salis']}}</td>
                    <td>{{$row['uzsakymu_sk']}}</td>
                </tr>
            @endforeach
        </table>
    </div>
</div>

@endsection