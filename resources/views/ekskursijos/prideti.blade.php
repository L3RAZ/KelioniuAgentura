@extends('layouts.layout')
@section('content')
<div class="container">
<h2 class="col-12 col-sm-12 col-md-12 col-xs-12">Pridėti ekskursiją</h2>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default" style="background-color: inherit;">

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="/ekskursijos/prideti">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('keliones_nr') ? ' has-error' : '' }}">
                        <label for="keliones_nr" class="col-md-4 control-label">Kelionėje:</label>

                        <div class="col-md-6">
                            <select name="keliones_nr" id="" class="form-control" required>
                            <option value="">---------</option>
                            @foreach($keliones as $kelione)
                     <option value="{{$kelione->id}}">{{$kelione->miesto_kodas}} - {{$kelione->valstybe}} </option>
                            @endforeach
                            </select>

                            @if ($errors->has('keliones_nr'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('keliones_nr') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                       
                        <div class="form-group{{ $errors->has('isvykimo_data') ? ' has-error' : '' }}">
                            <label for="isvykimo_data" class="col-md-4 control-label">Išvykimo data/laikas :</label>

                            <div class="col-md-6">
                                <input name="isvykimo_data" type="datetime-local" class="form-control" value="{{ old('isvykimo_data') }}" required>

                                @if ($errors->has('isvykimo_data'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('isvykimo_data') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('grizimo_data') ? ' has-error' : '' }}">
                            <label for="grizimo_data" class="col-md-4 control-label">Grįžimo data/laikas :</label>

                            <div class="col-md-6">
                                <input name="grizimo_data" type="datetime-local" class="form-control" value="{{ old('grizimo_data') }}" required>

                                @if ($errors->has('grizimo_data'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('grizimo_data') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('vieta') ? ' has-error' : '' }}">
                            <label for="vieta" class="col-md-4 control-label">Ekskursijos Vieta/Pavadinimas:</label>

                            <div class="col-md-6">
                                <input id="vieta" type="text" class="form-control" name="vieta" value="{{ old('vieta') }}" required>

                                @if ($errors->has('vieta'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('vieta') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('kaina') ? ' has-error' : '' }}">
                            <label for="kaina" class="col-md-4 control-label">Ekskursijos kaina:</label>

                            <div class="col-md-6">
                                <input name="kaina" type="number" step="0.01" class="form-control" value="{{ old('kaina') }}" required>

                                @if ($errors->has('kaina'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('kaina') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('gidas') ? ' has-error' : '' }}">
                            <label for="gidas" class="col-md-4 control-label">Gidas:</label>

                            <div class="col-md-6">
                                <input id="gidas" type="text" class="form-control" name="gidas" value="{{ old('gidas') }}" required>

                                @if ($errors->has('gidas'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('gidas') }}</strong>
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
                                    <a href="/keliones" class="btn btn-danger">Atšaukti</a>
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