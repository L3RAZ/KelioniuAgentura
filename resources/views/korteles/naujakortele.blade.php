@extends('layouts.layout')
@section('content')
<div class="container">
<h2 class="col-12 col-sm-12 col-md-12 col-xs-12">Nauja kortelė</h2>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default" style="background-color: inherit;">

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="/korteles">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('saskaitos_nr') ? ' has-error' : '' }}">
                            <label for="saskaitos_nr" class="col-md-4 control-label">Sąskaitos numeris</label>

                            <div class="col-md-6">
                                <input id="saskaitos_nr" type="text" class="form-control" name="saskaitos_nr" value="{{ old('saskaitos_nr') }}" required autofocus>

                                @if ($errors->has('saskaitos_nr'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('saskaitos_nr') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('banko_pavadinimas') ? ' has-error' : '' }}">
                            <label for="banko_pavadinimas" class="col-md-4 control-label">banko pavadinimas:</label>

                            <div class="col-md-6">
                                <input name="banko_pavadinimas" type="text" class="form-control" id="banko_pavadinimas" value="{{ old('banko_pavadinimas') }}" required autofocus>

                                @if ($errors->has('banko_pavadinimas'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('banko_pavadinimas') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('korteles_nr') ? ' has-error' : '' }}">
                            <label for="korteles_nr" class="col-md-4 control-label">Kortelės numeris:</label>

                            <div class="col-md-6">
                                <input name="korteles_nr" type="number" class="form-control" value="{{ old('korteles_nr') }}" required>

                                @if ($errors->has('korteles_nr'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('korteles_nr') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                        <label for="data" class="col-md-4 control-label">Kortelė gallioja iki:</label>
                            <div class="col-md-3">
                                <select class="form-control" name="korteles_data1">
                                    <option value="01">Sausio</option>
                                    <option value="02">Vasario</option>
                                    <option value="03">Kovo</option>
                                    <option value="04">Bazandžio</option>
                                    <option value="05">Gegužės</option>
                                    <option value="06">Birželio</option>
                                    <option value="07">Liepos</option>
                                    <option value="08">Rugpjūčio</option>
                                    <option value="09">Rugsėjo</option>
                                    <option value="10">Spalio</option>
                                    <option value="11">Lapkričio</option>
                                    <option value="12">Gruodžio</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <select class="form-control" name="korteles_data2">
                                    <option value="17"> 2017</option>
                                    <option value="18"> 2018</option>
                                    <option value="19"> 2019</option>
                                    <option value="20"> 2020</option>
                                    <option value="21"> 2021</option>
                                    <option value="22"> 2022</option>
                                </select>
                            </div>
                    </div>

                        <div class="form-group{{ $errors->has('CVV') ? ' has-error' : '' }}">
                            <label for="CVV" class="col-md-4 control-label">CVV:</label>

                            <div class="col-md-6">
                                <input name="CVV" type="number" class="form-control" saskaitos_nr="CVV" value="{{ old('CVV') }}" required>

                                @if ($errors->has('CVV'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('CVV') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group{{ $errors->has('horteles_tipas') ? ' has-error' : '' }}">
                            <label for="horteles_tipas" class="col-md-4 control-label">Kortelės tipas:</label>

                            <div class="col-md-6">
                                <select name="korteles_tipas" id="" class="form-control" required>
                                    <option value="">---------</option>
                                    <option value="Kreditinė">Kreditinė</option>
                                    <option value="Kreditinė">Debetinė</option>
                                </select>

                                @if ($errors->has('horteles_tipas'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('horteles_tipas') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group{{ $errors->has('savininko_vardas') ? ' has-error' : '' }}">
                            <label for="savininko_vardas" class="col-md-4 control-label">Savininko vardas:</label>

                            <div class="col-md-6">
                                <input id="savininko_vardas" type="text" class="form-control" name="savininko_vardas" value="{{ old('savininko_vardas') }}" required>

                                @if ($errors->has('savininko_vardas'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('savininko_vardas') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('savininko_pavarde') ? ' has-error' : '' }}">
                            <label for="savininko_pavarde" class="col-md-4 control-label">Savininko pavardė:</label>

                            <div class="col-md-6">
                                <input id="savininko_pavarde" type="text" class="form-control" name="savininko_pavarde" value="{{ old('savininko_pavarde') }}" required>

                                @if ($errors->has('savininko_pavarde'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('savininko_pavarde') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <input type="hidden" name="savininko_id" value="{{ request()->user()->id }}">
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