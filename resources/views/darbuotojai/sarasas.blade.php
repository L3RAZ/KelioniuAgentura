@extends('layouts.layout')

@section('content')
    <div class="container">
        <div class="row">
        <h2>Darbuotojų sąrašas</h2>
        </div>
<table style="width: 100%" class="table table-hover table-bordered">
    <thead>
        <tr><td>Darbuotojo ID</td><td>vardas</td><td>Pavardė</td><td>El. Paštas</td><td>Pareigos</td><td>Šalinti</td></tr>
    </thead>
    <tbody>
    @foreach($darbuotojai as $darbuotojas)
    <tr>
        <td>{{ $darbuotojas->id }}</td>
        <td>{{ $darbuotojas->name }}</td>
        <td>{{ $darbuotojas->surname }}</td>
        <td>{{ $darbuotojas->email }}</td>
        <td>{{ $darbuotojas->role }}</td>
        <td><form method="POST" action="/darbuotojai/{{$darbuotojas->id}}">
            {{ method_field('DELETE') }}
            {{ csrf_field() }}
            <button type="submit" class="btn btn-danger">Šalinti</button>
            </form>
        </td>         
    </tr>
    @endforeach
    </tbody>
</table>
    
    </div>
@endsection