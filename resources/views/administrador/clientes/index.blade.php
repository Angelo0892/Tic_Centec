@extends('adminlte::page')

@section('css')
    
@stop

@section('js')

@stop  

@section('title', 'index')

@section('content')

    @can('admin.cliente.crear')
        <a href="{{route('cliente.crear')}}">añadir cliente</a>
    @endcan
    
    @include('administrador.clientes.components.tabla')

@stop