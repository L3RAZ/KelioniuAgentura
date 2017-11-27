@extends('layouts.layout')
@section('content')
<div class="container">
<h2 class="col-12 col-sm-12 col-md-12 col-xs-12">Pridėti draudimą</h2>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default" style="background-color: inherit;">

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="/draudimai/prideti">
                        {{ csrf_field() }}


                        <div class="form-group{{ $errors->has('kaina') ? ' has-error' : '' }}">
                            <label for="kaina" class="col-md-4 control-label">Draudimo kaina:</label>

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
                        <label for="tipas" class="col-md-4 control-label">Draudimo tipas:</label>

                        <div class="col-md-6">
                            <select name="tipas" id="" class="form-control" required>
                            <option value="">---------</option>
                            @foreach($draudimo_tipai as $draudimo_tipas)
                     <option value="{{$draudimo_tipas->id}}">{{$draudimo_tipas->tipas}}</option>
                            @endforeach
                            </select>

                            @if ($errors->has('tipas'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('tipas') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group{{ $errors->has('galioja_nuo') ? ' has-error' : '' }}">
                        <label for="galioja_nuo" class="col-md-4 control-label">Galioja nuo:</label>

                        <div class="col-md-6">
                            <input name="galioja_nuo" type="date" class="form-control" value="{{ old('galioja_nuo') }}" required>

                            @if ($errors->has('galioja_nuo'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('galioja_nuo') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('galioja_iki') ? ' has-error' : '' }}">
                        <label for="galioja_iki" class="col-md-4 control-label">Galioja iki:</label>

                        <div class="col-md-6">
                            <input name="galioja_iki" type="date" class="form-control" value="{{ old('galioja_iki') }}" required>

                            @if ($errors->has('galioja_iki'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('galioja_iki') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                        <div class="form-group{{ $errors->has('draudimo_imone') ? ' has-error' : '' }}">
                            <label for="draudimo_imone" class="col-md-4 control-label">Draudimo įmonė:</label>

                            <div class="col-md-6">
                                <input id="draudimo_imone" type="text" class="form-control" name="draudimo_imone" value="{{ old('draudimo_imone') }}" required>

                                @if ($errors->has('draudimo_imone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('draudimo_imone') }}</strong>
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
                                    <a href="/draudimai" class="btn btn-danger">Atšaukti</a>
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