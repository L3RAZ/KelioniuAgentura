@extends('layouts.layout')

@section('content')
<div class="container">

    <div class="row">
        <a style="margin-left: 10%; padding-top: 15%;" href="{{ url('/klientouzsakymai') }}"><< Atgal</a>
    </div>


    <div class="row">
        <div class="infoBox">
            <div class="row">
                <h4>Viešbutis</h4>
                <p style="text-align: center;">Pastaba: viešbutį leidžiama užsakyti tik vieną kartą.</p>
            </div>
            @if(!empty($viesbutis) > 0)
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
                        <td>{{ $viesbutis->adresas}}, {{ $viesbutis->miesto_pav }}</td>
                    </tr> 
                    <tr>
                        <td>Telefono nr: </td>
                        <td>{{ $viesbutis->telefono_nr}}</td>
                    </tr>  
                </table>
            </div>
            @else 
            <div class="row"><h4>Jūs nesate užsisake šios paslaugos.</h4></div>
            <div class="row">
                <div class="col-4 col-sm-4 col-md-4 col-xs-4 col-md-offset-4" ><input type="button" name="uzsakyti" value="Užsakyti draudimą" class="button"></div>
            </div>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="infoBox">
            <div class="row">
                <h4>Ekskursijos</h4>
            </div>
            @if(count($ekskursijos) > 0)
            <div class="row"> 
                @foreach($ekskursijos as $ekskursija)
                <div class="row">
    
                    <table class="kelioneInfoTable">
                        <tr>
                            <td>Išvykimo data: </td>
                            <td>{{ $ekskursija->isvykimo_data}}</td>
                        </tr>
                        <tr>
                            <td>Grįžimo data: </td>
                            <td>{{ $ekskursija->grizimo_data}}</td>
                        </tr>
                        <tr>
                            <td>Vieta: </td>
                            <td>{{ $ekskursija->vieta}}</td>
                        </tr>
                        <tr>
                            <td>Kaina: </td>
                            <td>{{ $ekskursija->kaina}} &euro;</td>
                        </tr> 
                        <tr>
                            <td>Gidas: </td>
                            <td>{{ $ekskursija->gidas}}</td>
                        </tr>  
                    </table>
        
                </div>
                @endforeach
            </div>
            @else 
            <div class="row"><h4>Jūs nesate užsisake šios paslaugos.</h4></div>
            @endif
            <div class="row">
                <div class="col-4 col-sm-4 col-md-4 col-xs-4 col-md-offset-4" ><input type="button" name="uzsakyti" value="Užsakyti ekskursijas" class="button"></div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="infoBox">
            <div class="row">
                <h4>Automobilio nuoma</h4>
            </div>
            @if(count($auto_nuomos) > 0)
            <div class="row">
                @foreach($auto_nuomos as $auto_nuoma)
                <div class="row">
        
                    <table class="kelioneInfoTable">
                        <tr>
                            <td>Nuomos pradžios data: </td>
                            <td>{{ $auto_nuoma->pradzios_data}}</td>
                        </tr>
                        <tr>
                            <td>Nuomos pabaigos data: </td>
                            <td>{{ $auto_nuoma->pabaigos_data}}</td>
                        </tr>
                        <tr>
                            <td>Kaina: </td>
                            <td>{{ $auto_nuoma->bendra_kaina}} &euro;</td>
                        </tr>
                        <!-- isvesti info apie automobili --> 
                    </table>
        
                </div>
                @endforeach
            </div>
            @else 
            <div class="row"><h4>Jūs nesate užsisake šios paslaugos.</h4></div>
            @endif
            <div class="row">
                <div class="col-4 col-sm-4 col-md-4 col-xs-4 col-md-offset-4" ><input type="button" name="uzsakyti" value="Užsakyti automobilio nuomą" class="button"></div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="infoBox">
            <div class="row">
                <h4>Draudimas</h4>
                <p style="text-align: center;">Pastaba: leidžiama užsakyti tik vieno tipo draudimą.</p>
            </div>
            @if(!empty($draudimas) > 0)
            <div class="row">
                <table class="kelioneInfoTable">
                    <tr>
                        <td>Galioja nuo: </td>
                        <td>{{ $draudimas->galioja_nuo}}</td>
                    </tr>
                    <tr>
                        <td>Galioja iki: </td>
                        <td>{{ $draudimas->galioja_iki}}</td>
                    </tr>
                    <tr>
                        <td>Darudimo įmonė: </td>
                        <td>{{ $draudimas->draudimo_imone}}</td>
                    </tr>
                    <tr>
                        <td>Kaina: </td>
                        <td>{{ $draudimas->kaina}} &euro;</td>
                    </tr> 
                    <tr>
                        <td>Tipas: </td>
                        <td>{{ $draudimas->tipas}}</td>
                    </tr>  
                </table>
            </div>
            @else 
            <div class="row"><h4>Jūs nesate užsisake šios paslaugos.</h4></div>
            <div class="row">
                <div class="col-4 col-sm-4 col-md-4 col-xs-4 col-md-offset-4" ><input type="button" name="uzsakyti" value="Užsakyti draudimą" class="button"></div>
            </div>
            @endif
        </div>
    </div>

    
</div>
@endsection