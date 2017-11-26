@extends('layouts.layout')
@section('content')
<div class="container">
<h2 class="col-12 col-sm-12 col-md-12 col-xs-12">Pridėti miestą</h2>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default" style="background-color: inherit;">

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="/miestai/prideti"> 
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('pavadinimas') ? ' has-error' : '' }}">
                            <label for="pavadinimas" class="col-md-4 control-label">Miesto pavadinimas:</label>

                            <div class="col-md-6">
                                <input name="pavadinimas" type="text" class="form-control" id="pavadinimas" value="{{ old('pavadinimas') }}" required autofocus>

                                @if ($errors->has('pavadinimas'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('pavadinimas') }}</strong>
                                    </span>
                                @endif
                            </div>

                        </div>
                        <div class="form-group{{ $errors->has('salis') ? ' has-error' : '' }}">
                            <label for="salis" class="col-md-4 control-label">Šalis:</label>

                            <div class="col-md-6">
                                <input name="salis" type="text" class="form-control" id="salis" value="{{ old('salis') }}" required autofocus>

                                @if ($errors->has('salis'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('salis') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('pasto_kodas') ? ' has-error' : '' }}">
                        <label for="pasto_kodas" class="col-md-4 control-label">Miesto pašto kodas:</label>

                        <div class="col-md-6">
                            <input name="pasto_kodas" type="number" class="form-control" id="pasto_kodas" value="{{ old('pasto_kodas') }}" required autofocus>

                            @if ($errors->has('pasto_kodas'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('pasto_kodas') }}</strong>
                                </span>
                            @endif
                        </div>
                        </div>

                    <div class="form-group{{ $errors->has('meras') ? ' has-error' : '' }}">
                            <label for="meras" class="col-md-4 control-label">Miesto meras:</label>

                            <div class="col-md-6">
                                <input name="meras" type="text" class="form-control" id="meras" value="{{ old('meras') }}" required autofocus>

                                @if ($errors->has('meras'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('meras') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('savivaldybe') ? ' has-error' : '' }}">
                            <label for="savivaldybe" class="col-md-4 control-label">Savivaldybė:</label>

                            <div class="col-md-6">
                                <input name="savivaldybe" type="text" class="form-control" id="savivaldybe" value="{{ old('savivaldybe') }}" required autofocus>

                                @if ($errors->has('savivaldybe'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('savivaldybe') }}</strong>
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
                                    <a href="/miestai" class="btn btn-danger">Atšaukti</a>
                                </div>
                            </div>
                            </div>
                        </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection@extends('layouts.layout')
@section('content')
<div class="container">
<h2 class="col-12 col-sm-12 col-md-12 col-xs-12">Pridėti miestą</h2>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default" style="background-color: inherit;">

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="/miestai/prideti"> 
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('pavadinimas') ? ' has-error' : '' }}">
                            <label for="pavadinimas" class="col-md-4 control-label">Miesto pavadinimas:</label>

                            <div class="col-md-6">
                                <input name="pavadinimas" type="text" class="form-control" id="pavadinimas" value="{{ old('pavadinimas') }}" required autofocus>

                                @if ($errors->has('pavadinimas'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('pavadinimas') }}</strong>
                                    </span>
                                @endif
                            </div>

                        </div>
                        <div class="form-group{{ $errors->has('salis') ? ' has-error' : '' }}">
                            <label for="salis" class="col-md-4 control-label">Šalis:</label>

                            <div class="col-md-6">
                                <input name="salis" type="text" class="form-control" id="salis" value="{{ old('salis') }}" required autofocus>

                                @if ($errors->has('salis'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('salis') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('pasto_kodas') ? ' has-error' : '' }}">
                        <label for="pasto_kodas" class="col-md-4 control-label">Miesto pašto kodas:</label>

                        <div class="col-md-6">
                            <input name="pasto_kodas" type="number" class="form-control" id="pasto_kodas" value="{{ old('pasto_kodas') }}" required autofocus>

                            @if ($errors->has('pasto_kodas'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('pasto_kodas') }}</strong>
                                </span>
                            @endif
                        </div>
                        </div>

                    <div class="form-group{{ $errors->has('meras') ? ' has-error' : '' }}">
                            <label for="meras" class="col-md-4 control-label">Miesto meras:</label>

                            <div class="col-md-6">
                                <input name="meras" type="text" class="form-control" id="meras" value="{{ old('meras') }}" required autofocus>

                                @if ($errors->has('meras'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('meras') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('savivaldybe') ? ' has-error' : '' }}">
                            <label for="savivaldybe" class="col-md-4 control-label">Savivaldybė:</label>

                            <div class="col-md-6">
                                <input name="savivaldybe" type="text" class="form-control" id="savivaldybe" value="{{ old('savivaldybe') }}" required autofocus>

                                @if ($errors->has('savivaldybe'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('savivaldybe') }}</strong>
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
                                    <a href="/korteles" class="btn btn-danger">Atšaukti</a>
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