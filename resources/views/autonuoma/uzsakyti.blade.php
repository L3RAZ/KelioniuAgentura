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
    @if(count($automobiliai) > 0)
    <div class="infoBox">
        <div class="row"><h4>Galimi automobiliai:</h4></div>
        @foreach($automobiliai as $automobilis)
            <div class="row">
    
                <table class="kelioneInfoTable">
                    <tr>
                        <td>Markė: </td>
                        <td>{{ $automobilis->marke}}</td>
                    </tr>
                    <tr>
                        <td>Modelis: </td>
                        <td>{{ $automobilis->modelis}}</td>
                    </tr>
                    <tr>
                        <td>Pagaminimo metai: </td>
                        <td>{{ $automobilis->pagaminimo_metai}}</td>
                    </tr> 
                    <tr>
                        <td>Paros kaina: </td>
                        <td>{{ $automobilis->paros_kaina}} &euro;</td>
                    </tr>
                </table>
    
            </div>
        @endforeach
    </div>

    <div  id="uzsakymasForm">
        <form method="post">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            <div class="row" >
                <label for="pradzios_data" class="col-md-5 control-label" name="pradzioslabel">Nurodykite nuomos pražios datą: </label>
                <div class="col-md-6">
                    <input name="pradzios_data" type="date" style="color: black;">
                </div>
            </div>

            <div class="row" >
                <label for="pabaigos_data" class="col-md-5 control-label" name="pabaigoslabel">Nurodykite nuomos pabaigos datą: </label>
                <div class="col-md-6">
                    <input name="pabaigos_data" type="date" style="color: black;" >
                </div>
            </div>

            <div class="row" >
                <label for="automobilio_nr" class="col-md-5 control-label" name="autolabel">Pasirinkite automobilį: </label>
                <div class="col-md-6">
                    <select id="automobilio_nr" type="text" class="form-control" name="automobilio_nr">
                        <option value="" ></option>
                        @foreach($automobiliai as $automobilis)
                            <option value="{{ $automobilis->nr }}">{{ $automobilis->marke }} {{ $automobilis->modelis }}</option>
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
    @else
    <h4>Laisvų automobilių nėra</h4>
    <div class="row">
    <div class="col-4 col-sm-4 col-md-4 col-xs-4 col-md-offset-4" onclick="window.history.back()" ><input type="button" name="uzsakyti" value="Grįžti atgal" class="button"></div>
    </div>
    @endif
</div>
@endsection