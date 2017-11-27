@extends('layouts.layout')
@section('content')
<div class="container">
    @if(count($sutartys) > 0)

    <div class="row">
        <h2>Laukiančios patvirtinimo sutartys</h2>
    </div>
<table style="width: 100%" class="table table-hover table-bordered">
    <thead>
        <tr><td>Sutarties numeris</td><td>Sutarties užsakovas</td><td>Kelionė</td><td>Būsena</td><td>Patvirtinti</td><td>Šalinti sutartį</td></tr>
    </thead>
    <tbody>
    @foreach($sutartys as $sutartis)
    <tr>
        <td>{{ $sutartis->nr }}</td>
        <td>{{ $sutartis->uzsakovas }}</td>
        <td>{{ $sutartis->kelione }}{{$sutartis->miestas}}</td>
        <td>{{ $sutartis->sut_busena }}</td>
        <td>
            <form method="POST" action="/sutartys/{{ $sutartis->nr }}">
            <input type="hidden" value="{{ $sutartis->nr }}"name="id">
                {{ method_field('PATCH') }}
                {{ csrf_field() }}
                <input type="hidden" name="busena" value="{{ ($sutartis->busena == 2 ? 3 : 5) }}">
                @if($sutartis->busena !== 2 || $sutartis->busena !==4)
                <button type="button" class="btn btn-basic disabled">Patvirtinti</button>
                @else
                <button type="submit" class="btn btn-success">Patvirtinti</button>
                @endif
        </td>
        <td>
        <button type="submit" name="yra_archyvuota" value="1" class="btn btn-danger">Šalinti</button>
        </form>
        </td>           
    </tr>
    @endforeach
    </tbody>
</table>
    @else
    <h2>Šiuo metu nėra sutarčių, laukiančių patvirtinimo</h2>
    @endif
</div>
@endsection