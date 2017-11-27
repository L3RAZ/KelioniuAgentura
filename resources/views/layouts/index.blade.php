@extends('layouts.layout')

@section('content')
<div class="container">
<!-- paslepti nuo kliento, darbuotojo ir neprisijungusio 
<div class="row">
    <div class="col-12 col-sm-12 col-md-12 col-xs-12"><input type="button" name="admin" value="Administratoriaus sąsaja" class="button"></div>
</div>
<!-- paslepti nuo kliento, admino ir neprisijungusio 
<div class="row">
    <div class="col-12 col-sm-12 col-md-12 col-xs-12"><input type="button" name="admin" value="Darbuotojo sąsaja" class="button"></div>
</div>
<!-- paslepti nuo darbuotojo, admino ir neprisijungusio 
<div class="row">
    <div class="col-12 col-sm-12 col-md-12 col-xs-12"><input type="button" name="admin" value="Jūsų sutartys" class="button" onClick="window.location='{{ url('/klientouzsakymai') }}'"></div>
</div> -->
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