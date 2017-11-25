@extends('layouts.layout')

@section('content')
<div class="container">
    <div class="row">
        <h2 class="col-12 col-sm-12 col-md-12 col-xs-12">Užsakymas</h2>
    </div>
<div class="row">
    <a href="{{ url('/') }}"><< Atgal į pradžią</a>
</div>
<div class="row">
    <p>Jūsų pasirinkta kelionė: {{ Session::get('kelione')->valstybe}}  {{Session::get('kelione')->miesto_pav}} {{Session::get('kelione')->kaina}} &euro;</p>
</div>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form method="post">
<input type="hidden" name="_token" value="{{ csrf_token() }}">
<div class="row" >
    <label for="pas_data" class="col-md-4 control-label" name="datalabel">Pasirinkite norimą datą: </label>
    <div class="col-md-6">
        <select id="pasirinkta_data" type="text" class="form-control" name="pasirinkta_data">
            <option value="" ></option>
            @foreach($datos as $data)
                <option value="{{ $data->id }}">{{ $data->isvykimo_data }} - {{ $data->grizimo_data }}</option>
            @endforeach
        </select>
    </div>
</div>

<div class="row" >
    <label for="viesbutis" class="col-md-4 control-label" name="viesbutislabel">Pasirinkite viešbutį: </label>
    <div class="col-md-6">
        <select id="viesbutis" type="text" class="form-control" name="viesbutis">
            <option value="" ></option>
            @foreach($viesbuciai as $viesbutis)
                <option value="{{ $viesbutis->viesbucio_id }}">{{ $viesbutis->pavadinimas }} {{ $viesbutis->reitingas }}</option>
            @endforeach
        </select>
    </div>
</div>

<input id="sukurimo_data" type="hidden" value="<?php echo date("Y-m-d");?>">
<input id="yra_archyvuota" type="hidden" value="true">
<input id="busena" type="hidden" value="1">
<input id="vartotojo_id" type="hidden" value="1"><!-- pakeisti i vartotojo id pagal sesija -->

<div class="form-group">
    <div class="col-md-6 col-md-offset-4">
        <button type="submit" method="post" class="btn btn-primary">Užsakyti</button>                            
    </div> 
</div>
</form>

</div>
@endsection