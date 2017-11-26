

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
                <td>Asmenų skaičius: </td>
                <td>{{ $sutartis->zmoniu_sk}}</td>
            </tr>
            <tr>
                <td>Užsakymo kaina: </td>
                <td>{{ $sutartis->bendra_kaina}} &euro;</td>
            </tr>
            <tr>
                <td colspan="2"><a href="{{ url('/klientouzsakymai/'.$sutartis->nr) }}" onClick="PaslaugosController::show($sutartis->nr)">Papildomos paslaugos</a></td>
            </tr>
            <tr>
                <td>
                    @if(request()->user()->hasCards())
                    <form method="POST" action="/sutartys/{{ $sutartis->nr }}">
                    {{ method_field('PATCH') }}
                    {{ csrf_field() }}
                        <input type="hidden" name="busena" value="2">
                        <button type="submit" class="btn btn-success">Apmokėti</button>
                    </form>
                    @else
                        <button class="btn disabled">Apmokėti</button>
                    @endif
                </td>
                <td>
                    <form method="POST" action="/sutartys/{{ $sutartis->nr }}">
                        {{ method_field('PATCH') }}
                        {{ csrf_field() }}
                        <input type="hidden" name="busena" value="4">
                        <button type="submit" class="btn btn-danger">Atšaukti</button>
                    </form>
                </td>
            </tr>
        </table>
    
    </div>
    @endforeach
    <div class="center">
        {!! $kliento_sutartys->render() !!}
    </div>
</div>
@endsection