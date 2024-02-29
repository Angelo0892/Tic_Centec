@extends('adminlte::page')

@section('css')
    <link rel="stylesheet" href="{{asset('css/administrador.css')}}">
@stop

@section('js')
    
@stop

@section('title', 'index')


@section('content')

    <section>
        <form method="POST" action="{{route('vendedor_cajas.almacenar')}}" >
            @csrf

            @include('administrador.vendedor_cajas.components.formulario')
        </form>
    </section>

@stop