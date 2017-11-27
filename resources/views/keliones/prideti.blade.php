@extends('layouts.layout')
@section('content')
<div class="container">
<h2 class="col-12 col-sm-12 col-md-12 col-xs-12">Pridėti kelionę</h2>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default" style="background-color: inherit;">

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="/keliones/prideti">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('miesto_kodas') ? ' has-error' : '' }}">
                        <label for="miesto_kodas" class="col-md-4 control-label">Miestas:</label>

                        <div class="col-md-6">
                            <select name="miesto_kodas" id="" class="form-control" required>
                            <option value="">---------</option>
                            @foreach($miestai as $miestas)
                     <option value="{{$miestas->kodas}}">{{$miestas->pavadinimas}} - {{$miestas->salis}}</option>
                            @endforeach
                            </select>

                            @if ($errors->has('miesto_kodas'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('miesto_kodas') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('valstybe') ? ' has-error' : '' }}">
                            <label for="valstybe" class="col-md-4 control-label">Valstybė:</label>

                            <div class="col-md-6">
                                <input name="valstybe" type="text" class="form-control" id="valstybe" value="{{ old('valstybe') }}" required autofocus>

                                @if ($errors->has('valstybe'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('valstybe') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('kaina') ? ' has-error' : '' }}">
                            <label for="kaina" class="col-md-4 control-label">Kelionės kaina:</label>

                            <div class="col-md-6">
                                <input name="kaina" type="number" step="0.01" class="form-control" value="{{ old('kaina') }}" required>

                                @if ($errors->has('kaina'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('kaina') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        
                        <div class="form-group{{ $errors->has('tipas') ? ' has-error' : '' }}">
                        <label for="tipas" class="col-md-4 control-label">Kelionės tipas:</label>

                        <div class="col-md-6">
                            <select name="tipas" id="" class="form-control" required>
                            <option value="">---------</option>
                            @foreach($keliones_tipai as $keliones_tipas)
                     <option value="{{$keliones_tipas->id}}">{{$keliones_tipas->tipas}}</option>
                            @endforeach
                            </select>

                            @if ($errors->has('tipas'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('tipas') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group{{ $errors->has('transporto_priemones') ? ' has-error' : '' }}">
                            <label for="transporto_priemones" class="col-md-4 control-label">Transportas:</label>

                            <div class="col-md-6">
                                <input id="transporto_priemones" type="text" class="form-control" name="transporto_priemones" value="{{ old('transporto_priemones') }}" required>

                                @if ($errors->has('transporto_priemones'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('transporto_priemones') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('aprasymas') ? ' has-error' : '' }}">
                            <label for="aprasymas" class="col-md-4 control-label">Kelionės aprašymas:</label>

                            <div class="col-md-6">
                                <input id="aprasymas" type="text" class="form-control" name="aprasymas" value="{{ old('aprasymas') }}" required>

                                @if ($errors->has('aprasymas'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('aprasymas') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="container" style="width: 100%; !important">
                            <div class="row">
                                <div class="col-md-4 col-md-offset-4">
                                    <button type="submit" class="btn btn-success">Pridėti</button>
                                </div>
                                </form>
                                <div class="col-md-1">
                                    <a href="/" class="btn btn-danger">Atšaukti</a>
                                </div>
                            </div>
                            </div>
                        </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection