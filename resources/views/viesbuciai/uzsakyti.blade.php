@extends('layouts.layout')

@section('content')

<div class="container">
    <div class="row">
        <h2 class="col-12 col-sm-12 col-md-12 col-xs-12">Viešbučio užsakymas</h2>
    </div>

    <div class="infoBox">
        <div class="row"><h4>Galimi viešbučiai:</h4></div>
        @foreach($viesbuciai as $viesbutis)
            <div class="row">
    
                <table class="kelioneInfoTable">
                    <tr>
                        <td>Pavadinimas: </td>
                        <td>{{ $viesbutis->pavadinimas}}</td>
                    </tr>
                    <tr>
                        <td>Reitingas: </td>
                        <td>{{ $viesbutis->reitingas}}</td>
                    </tr>
                    <tr>
                        <td>Paros kaina: </td>
                        <td>{{ $viesbutis->paros_kaina}} &euro;</td>
                    </tr> 
                    <tr>
                        <td>Adresas: </td>
                        <td>{{ $viesbutis->adresas}}</td>
                    </tr> 
                    <tr>
                        <td>Telefono nr.: </td>
                        <td>{{ $viesbutis->tel_nr}}</td>
                    </tr> 
                </table>
    
            </div>
        @endforeach
        </div>


    <div  id="uzsakymasForm">
        <form method="post">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
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

            <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                    <button type="submit" method="post" class="btn btn-primary">Užsakyti</button>                            
                </div> 
            </div>
        </form>
    </div>
</div>
@endsection
