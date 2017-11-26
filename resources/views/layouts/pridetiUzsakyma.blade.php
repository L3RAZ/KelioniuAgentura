@extends('layouts.layout')

@section('content')
<div class="container">
    <div class="row">
        <h2 class="col-12 col-sm-12 col-md-12 col-xs-12">Užsakymas</h2>
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

<div class="row">
    <h4>Jūsų pasirinkta kelionė: {{ Session::get('kelione')->valstybe}}  {{Session::get('kelione')->miesto_pav}} {{Session::get('kelione')->kaina}} &euro;</h4>
</div>
<div  id="uzsakymasForm">
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
        <select id="viesbucio_id" type="text" class="form-control" name="viesbucio_id">
            <option value="" ></option>
            @foreach($viesbuciai as $viesbutis)
                <option value="{{ $viesbutis->viesbucio_id }}">{{ $viesbutis->pavadinimas }} {{ $viesbutis->reitingas }}</option>
            @endforeach
        </select>
    </div>
</div>

<div class="row" >
    <label for="zmoniu_sk" class="col-md-4 control-label" name="zmoniulabel">Nurodykite asmenų skaičių: </label>
    <div class="col-md-6">
        <input name="zmoniu_sk" type="text" style="color: black;">
    </div>
</div>

<input name="sudarymo_data" type="hidden" value="<?php echo date("Y-m-d");?>">
<input name="yra_archyvuota" type="hidden" value="0">
<input name="busena" type="hidden" value="1">
<input name="vartotojo_id" type="hidden" value="{{ Auth::id() }}"><!-- pakeisti i vartotojo id pagal sesija -->
<input name="keliones_nr" type="hidden" value="{{ Session::get('kelione')->id}}">
<input name="bendra_kaina" type="hidden" value="0">

<div class="form-group">
    <div class="col-md-6 col-md-offset-4">
        <button type="submit" method="post" class="btn btn-primary">Užsakyti</button>                            
    </div> 
</div>
</form>
</div>
</div>
@endsection