@extends('layouts.layout')

@section('content')
<div class="container">
<div class="row">
    <div class="col-6 col-sm-6 col-md-6 col-xs-6" style="width: 50%;"><input type="button" name="prisijungti" value="Prisijungti" class="button"></div>
    <div class="col-6 col-sm-6 col-md-6 col-xs-6" style="width: 50%;"><input type="button" name="registruotis" value="Registruotis" class="button"></div>
</div>
<h2 class="col-12 col-sm-12 col-md-12 col-xs-12">Kelionių pasiūlymai</h2>

<div class="row">
    <table id="kelionesTable">
            @foreach($keliones as $kelione)
                <tr class="tableRow">
                    <td style="width: 75%">{{$kelione['valstybe']}}  {{$kelione['miestas']}}     {{$kelione['kaina']}} &euro;</td>
                    <td><a href="{{ url('/keliones/'.$kelione['id']) }}" onClick="KelioneController::show($kelione['id'])" style="width: 25%;"> plačiau</a>
                </tr>
            @endforeach
    </table>
    <div class="center">
        {!! $keliones->render() !!}
    </div>
</div>
</div>


@endsection