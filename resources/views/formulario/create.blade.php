@extends('layout')

@section('title','Formulario de COVID-19')
@section('titulopag','Formulario COVID')
@section('elcontrolador','Formulario')
@section('laaccion','Llenar todos los campos')
    



@section('content')
@include('partials.session-status')
@include('partials.validation-errors')

<form action="{{ route('formulario.store')}}" method="POST">
        @include('formulario._form',['btnText'=>'Guardar'])
</form>

    
@endsection