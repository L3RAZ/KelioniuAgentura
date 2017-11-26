@extends('layouts.layout')
@section('content')
<div class="container">
<h2 class="col-12 col-sm-12 col-md-12 col-xs-12">Pridėti automobilį</h2>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default" style="background-color: inherit;">

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="/automobiliai/prideti">
                        {{ csrf_field() }}



                        <div class="form-group{{ $errors->has('marke') ? ' has-error' : '' }}">
                            <label for="marke" class="col-md-4 control-label">Markė:</label>

                            <div class="col-md-6">
                                <input name="marke" type="text" class="form-control" id="marke" value="{{ old('marke') }}" required autofocus>

                                @if ($errors->has('marke'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('marke') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('modelis') ? ' has-error' : '' }}">
                            <label for="modelis" class="col-md-4 control-label">Modelis:</label>

                            <div class="col-md-6">
                                <input name="modelis" type="text" class="form-control" id="modelis" value="{{ old('modelis') }}" required autofocus>

                                @if ($errors->has('modelis'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('modelis') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('variklio_turis') ? ' has-error' : '' }}">
                            <label for="variklio_turis" class="col-md-4 control-label">Darbinis tūris cm³:</label>

                            <div class="col-md-6">
                                <input name="variklio_turis" type="number" class="form-control" value="{{ old('variklio_turis') }}" required>

                                @if ($errors->has('variklio_turis'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('variklio_turis') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('variklio_galia') ? ' has-error' : '' }}">
                        <label for="variklio_galia" class="col-md-4 control-label">Variklio galia:</label>

                        <div class="col-md-6">
                            <input name="variklio_galia" type="number" class="form-control" value="{{ old('variklio_galia') }}" required>

                            @if ($errors->has('variklio_galia'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('variklio_galia') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                     <div class="form-group{{ $errors->has('pagaminimo_metai') ? ' has-error' : '' }}">
                            <label for="pagaminimo_metai" class="col-md-4 control-label">Pagaminimo metai:</label>

                            <div class="col-md-6">
                                <input name="pagaminimo_metai" type="number" class="form-control" value="{{ old('pagaminimo_metai') }}" required>

                                @if ($errors->has('pagaminimo_metai'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('pagaminimo_metai') }}</strong>
                                    </span>
                                @endif
                            </div>

                        </div>   
                        <div class="form-group{{ $errors->has('paros_kaina') ? ' has-error' : '' }}">
                        <label for="paros_kaina" class="col-md-4 control-label">Paros_kaina:</label>

                        <div class="col-md-6">
                            <input name="paros_kaina" type="number" class="form-control" value="{{ old('paros_kaina') }}" required>

                            @if ($errors->has('paros_kaina'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('paros_kaina') }}</strong>
                                </span>
                            @endif
                        </div>
                        </div>

                        <div class="form-group{{ $errors->has('duru_sk') ? ' has-error' : '' }}">
                            <label for="duru_sk" class="col-md-4 control-label">Durų skaičius:</label>

                            <div class="col-md-6">
                                <input name="duru_sk" type="number" class="form-control" value="{{ old('duru_sk') }}" required>

                                @if ($errors->has('duru_sk'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('duru_sk') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('registracijos_nr') ? ' has-error' : '' }}">
                            <label for="registracijos_nr" class="col-md-4 control-label">Registracijos numeris:</label>

                            <div class="col-md-6">
                                <input id="registracijos_nr" type="text" class="form-control" name="registracijos_nr" value="{{ old('registracijos_nr') }}" required>

                                @if ($errors->has('registracijos_nr'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('registracijos_nr') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('pavaru_deze') ? ' has-error' : '' }}">
                        <label for="pavaru_deze" class="col-md-4 control-label">Pavarų dėžė:</label>
    
                        <div class="col-md-6">
                            <select name="pavaru_deze" id="" class="form-control" required>
                                <option value="">---------</option>
                                <option value="Automatinė">Automatinė</option>
                                <option value="Mechaninė">Mechaninė</option>
    
                            </select>
    
                            @if ($errors->has('pavaru_deze'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('pavaru_deze') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('kebulo_tipas') ? ' has-error' : '' }}">
                    <label for="kebulo_tipas" class="col-md-4 control-label">Kėbulo tipas:</label>

                    <div class="col-md-6">
                        <select name="kebulo_tipas" id="" class="form-control" required>
                            <option value="">---------</option>
                            <option value="Sedanas">Sedanas</option>
                            <option value="Hečbekas">Hečbekas</option>
                            <option value="Pikapas">Pikapas</option>
                            <option value="Kabrioletas">Kabrioletas</option>
                            <option value="Universalas">Universalas</option>

                        </select>

                        @if ($errors->has('kebulo_tipas'))
                            <span class="help-block">
                                <strong>{{ $errors->first('kebulo_tipas') }}</strong>
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
                                    <a href="/automobiliai" class="btn btn-danger">Atšaukti</a>
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