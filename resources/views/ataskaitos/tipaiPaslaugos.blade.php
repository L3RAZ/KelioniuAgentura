@extends('layouts.layout')

@section('content')

<div class="container">

    <h2 class="col-12 col-sm-12 col-md-12 col-xs-12">Užsakytų papildomų paslaugų bendra suma pagal kelionės tipą</h2>
    
    <div class="row">
        <h4>Kelionės tipas: poilsinė</h4>
        <table id="kelionesTable">
            <tr class="tableRow">
                <th>Ekskursijos</th>
                <th>Draudimas</th>
                <th>Automobilio nuoma</th>
                <th>Viešbučiai</th>
            </tr>
            @foreach($poilsine as $row)
                <tr class="tableRow">
                    <td>{{$row['eksk_kaina']}} &euro;</td>
                    <td>{{$row['draud_kaina']}} &euro;</td>
                    <td>{{$row['auto_kaina']}} &euro;</td>
                    <td>{{$row['vies_kaina']}} &euro;</td>
                </tr>
            @endforeach
        </table>
    </div><br><br><br><br>

    <div class="row">
        <h4>Kelionės tipas: pažintinė</h4>
        <table id="kelionesTable">
            <tr class="tableRow">
                <th>Ekskursijos</th>
                <th>Draudimas</th>
                <th>Automobilio nuoma</th>
                <th>Viešbučiai</th>
            </tr>
            @foreach($pazintine as $row)
                <tr class="tableRow">
                    <td>{{$row['eksk_kaina']}} &euro;</td>
                    <td>{{$row['draud_kaina']}} &euro;</td>
                    <td>{{$row['auto_kaina']}} &euro;</td>
                    <td>{{$row['vies_kaina']}} &euro;</td>
                </tr>
            @endforeach
        </table>
    </div><br><br><br><br>

    <div class="row">
        <h4>Kelionės tipas: aktyvaus poilsio</h4>
        <table id="kelionesTable">
            <tr class="tableRow">
                <th>Ekskursijos</th>
                <th>Draudimas</th>
                <th>Automobilio nuoma</th>
                <th>Viešbučiai</th>
            </tr>
            @foreach($aktyvi as $row)
                <tr class="tableRow">
                    <td>{{$row['eksk_kaina']}} &euro;</td>
                    <td>{{$row['draud_kaina']}} &euro;</td>
                    <td>{{$row['auto_kaina']}} &euro;</td>
                    <td>{{$row['vies_kaina']}} &euro;</td>
                </tr>
            @endforeach
        </table>
    </div>

</div>

@endsection