@extends('adminlte::page')

@section('css')
    <link rel="stylesheet" href="{{asset('css/administrador.css')}}">
@stop

@section('js')
    
@stop

@section('title', 'index')


@section('content')

    @can('admin.servicio.crear')
        <a href="{{route('servicio.crear')}}">añadir servicio</a>
    @endcan
    
    
    @include('administrador.servicios.components.tabla')

@stop