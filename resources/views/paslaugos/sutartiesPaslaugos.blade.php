@extends('layouts.layout')

@section('content')

@if ( $ekskursijos[0] == NULL )
<p>nera</p>
@else
<p>yra</p>
@endif
@endsection