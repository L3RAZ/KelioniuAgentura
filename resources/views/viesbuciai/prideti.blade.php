@extends('layouts.layout')
@section('content')
<div class="container">
<h2 class="col-12 col-sm-12 col-md-12 col-xs-12">Pridėti viešbutį</h2>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default" style="background-color: inherit;">

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="/viesbuciai/prideti"> 
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

                        <div class="form-group{{ $errors->has('pavadinimas') ? ' has-error' : '' }}">
                            <label for="pavadinimas" class="col-md-4 control-label">Viešbučio pavadinimas:</label>

                            <div class="col-md-6">
                                <input name="pavadinimas" type="text" class="form-control" id="pavadinimas" value="{{ old('pavadinimas') }}" required autofocus>

                                @if ($errors->has('pavadinimas'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('pavadinimas') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('reitingas') ? ' has-error' : '' }}">
                        <label for="reitingas" class="col-md-4 control-label">Viešbučio reitingas:</label>

                        <div class="col-md-6">
                            <input name="reitingas" type="text" class="form-control" id="reitingas" value="{{ old('reitingas') }}" required autofocus>

                            @if ($errors->has('reitingas'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('reitingas') }}</strong>
                                </span>
                            @endif
                        </div>
                        </div>

                        <div class="form-group{{ $errors->has('paros_kaina') ? ' has-error' : '' }}">
                        <label for="reitingas" class="col-md-4 control-label">Paros kaina:</label>

                        <div class="col-md-6">
                            <input name="paros_kaina" type="number" step="0.01" class="form-control" value="{{ old('paros_kaina') }}" required>

                            @if ($errors->has('paros_kaina'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('paros_kaina') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('adresas') ? ' has-error' : '' }}">
                            <label for="adresas" class="col-md-4 control-label">Viešbučio adresas:</label>

                            <div class="col-md-6">
                                <input name="adresas" type="text" class="form-control" id="adresas" value="{{ old('adresas') }}" required autofocus>

                                @if ($errors->has('adresas'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('adresas') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('telefono_nr') ? ' has-error' : '' }}">
                            <label for="telefono_nr" class="col-md-4 control-label">Viešbučio Tel.Nr:</label>

                            <div class="col-md-6">
                                <input name="telefono_nr" type="text" class="form-control" id="telefono_nr" value="{{ old('telefono_nr') }}" required autofocus>

                                @if ($errors->has('telefono_nr'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('telefono_nr') }}</strong>
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