@extends('layouts.layout')

@section('content')

<div class="container">
    <div class="row">
        <h2 class="col-12 col-sm-12 col-md-12 col-xs-12">Ekskurijų užsakymas</h2>
    </div>

    @if(count($ekskursijos) > 0)
    <div  id="uzsakymasForm">
        <form method="post">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="row" >
                @foreach($ekskursijos as $ekskursija)
                    <div class="col-md-1">
                    
                        <input type="checkbox" value="{{ $ekskursija->nr }}" name="ekskursijos_nr">
                    </div>
                    <div class="col-md-11">
                        <label for="ekskursijos_nr">
                            Išvykimo data: {{ $ekskursija->isvykimo_data }},<br>
                            Grįžimo data: {{ $ekskursija->grizimo_data }},<br>
                            Vieta: {{ $ekskursija->vieta }},<br>
                            Gidas: {{ $ekskursija->gidas }},<br>
                            Kaina vienam asmeniui: {{ $ekskursija->kaina }} &euro;<br><br><br>
                        </label>
                    
                    </div>
                @endforeach
            </div>

            <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                    <button type="submit" method="post" class="btn btn-primary">Užsakyti</button>                            
                </div> 
            </div>
        </form>
    </div>
    @else
    <h4>Ekskursijų pasiūlymų nėra</h4>
    <div class="row">
    <div class="col-4 col-sm-4 col-md-4 col-xs-4 col-md-offset-4" onclick="window.history.back()" ><input type="button" name="uzsakyti" value="Grįžti atgal" class="button"></div>
    </div>
    @endif
</div>

@endsection