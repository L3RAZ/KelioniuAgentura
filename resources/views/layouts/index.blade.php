@extends('layouts.layout')

@section('content')
<div class="container">

<h2 class="col-12 col-sm-12 col-md-12 col-xs-12">Kelionių pasiūlymai</h2>

<div class="row">
    <table id="kelionesTable">
            <tr class="tableRow">
                <th>Kryptis</th>
                <th>Miestas</th>
                <th>Kaina asmeniui</th>
                <th></th>
            </tr>
            @foreach($keliones as $kelione)
                <tr class="tableRow">
                    <td>{{$kelione['valstybe']}}</td>
                    <td>{{$kelione['miestas']}}</td>
                    <td>{{$kelione['kaina']}} &euro;</td>
                    <td><a href="{{ url('/keliones/'.$kelione['id']) }}" onClick="KelioneController::show($kelione['id'])" style="width: 25%;"> plačiau</a></td>
                </tr>
            @endforeach
    </table>
    <div class="center">
        {!! $keliones->render() !!}
    </div>
</div>
</div>


@endsection