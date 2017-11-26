

@extends('layouts.layout')

@section('content')

<div class="container">
    <div class="row">
        <h2 class="col-12 col-sm-12 col-md-12 col-xs-12">Jūsų užsakymai</h2>
    </div>
    @foreach($kliento_sutartys as $sutartis)
    <div class="row">
    
        <table id="uzsakymasTable">
            <tr>
                <td>Sutarties nr.: </td>
                <td>{{ $sutartis->nr}}</td>
            </tr>
            <tr>
                <td>Sudarymo data: </td>
                <td>{{ $sutartis->sudarymo_data}}</td>
            </tr>
            <tr>
                <td>Sutarties būsena: </td>
                <td>{{ $sutartis->sut_busena}}</td>
            </tr> 
            <tr>
                <td>Kelionės kryptis: </td>
                <td>{{ $sutartis->valstybe}}</td>
            </tr> 
            <tr>
                <td>Miestas: </td>
                <td>{{ $sutartis->miestas}}</td>
            </tr>
            <tr>
                <td>Išvykimo data: </td>
                <td>{{ $sutartis->isvykimas}}</td>
            </tr>
            <tr>
                <td>Grįžimo data: </td>
                <td>{{ $sutartis->grizimas}}</td>
            </tr>   
            <tr>
                <td>Viešbutis: </td>
                <td>{{ $sutartis->vies_pav}}, {{ $sutartis->vies_adr }}</td>
            </tr> 
            <tr>
                <td>Asmenų skaičius: </td>
                <td>{{ $sutartis->zmoniu_sk}}</td>
            </tr>
            <tr>
                <td>Užsakymo kaina: </td>
                <td>{{ $sutartis->bendra_kaina}} &euro;</td>
            </tr>
            <tr>
                <td colspan="2"><a>Papildomos paslaugos</a></td>
            </tr>
            <tr>
                <td><a>Apmokėti</a></td>
                <td><a>Atšaukti</a></td>
            </tr>
        </table>
    
    </div>
    @endforeach
    <div class="center">
        {!! $kliento_sutartys->render() !!}
    </div>
</div>
@endsection