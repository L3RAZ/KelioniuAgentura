@extends('layouts.layout')

@section('content')

<div class="container">
    <div class="row">
        <h2 class="col-12 col-sm-12 col-md-12 col-xs-12">Draudimo užsakymas</h2>
    </div>

    <div class="infoBox">
        <div class="row"><h4>Galimi draudimai:</h4></div>
        @foreach($draudimai as $draudimas)
            <div class="row">
    
                <table class="kelioneInfoTable">
                    <tr>
                        <td>Draudimo įmonė: </td>
                        <td>{{ $draudimas->draudimo_imone}}</td>
                    </tr>
                    <tr>
                        <td>Tipas: </td>
                        <td>{{ $draudimas->tipas}}</td>
                    </tr>
                    <tr>
                        <td>Galioja nuo: </td>
                        <td>{{ $draudimas->galioja_nuo}} &euro;</td>
                    </tr> 
                    <tr>
                        <td>Galioja iki: </td>
                        <td>{{ $draudimas->galioja_iki}}</td>
                    </tr> 
                    <tr>
                        <td>Kaina: </td>
                        <td>{{ $draudimas->kaina}} &euro;</td>
                    </tr> 
                </table>
    
            </div>
        @endforeach
        </div>


    <div  id="uzsakymasForm">
        <form method="post">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="row" >
                <label for="draudimo_nr" class="col-md-4 control-label" name="draudimaslabel">Pasirinkite draudimą: </label>
                <div class="col-md-6">
                    <select id="draudimo_nr" type="text" class="form-control" name="draudimo_nr">
                        <option value="" ></option>
                        @foreach($draudimai as $draudimas)
                            <option value="{{ $draudimas->nr }}">{{ $draudimas->draudimo_imone }} {{ $draudimas->tipas }} {{ $draudimas->kaina }} &euro;</option>
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