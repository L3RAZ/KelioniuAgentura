@extends('layouts.layout')

@section('content')

<div class="container">

    <h2 class="col-12 col-sm-12 col-md-12 col-xs-12" style="">Bendra sutarčių kaina, tam tikru laikotarpiu</h2>
    <div  id="uzsakymasForm">
    <form method="post">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="row" >
        <label for="pradzios_data" class="col-md-5 control-label" name="pradzioslabel">Nurodykite laikotarpio pradžią: </label>
        <div class="col-md-6">
            <input name="pradzios_data" type="date" style="color: black;">
        </div>
    </div>

    <div class="row" >
        <label for="pabaigos_data" class="col-md-5 control-label" name="pabaigoslabel">Nurodykite laikotarpio pabaigą: </label>
        <div class="col-md-6">
            <input name="pabaigos_data" type="date" style="color: black;" >
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-6 col-md-offset-4">
            <button type="submit" method="post" class="btn btn-primary">Generuoti ataskaitą</button>                            
        </div> 
    </div>
    </form>
    </div>

    @if(!empty($ataskaita) > 0)
    <h2 style="padding: 10%;">Bendra suma: {{$ataskaita->suma}} &euro;</h2>
    @else
    @endif
</div>

@endsection