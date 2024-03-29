@extends('adminlte::page')

@section('css')   
<link rel="stylesheet" href="{{asset('css/administrador.css')}}">
@stop

@section('js')
@stop

@section('title', 'creacionMarca')

@section('content')

    <section>
        <form method="POST" action="{{route('marca.actualizar',$marca)}}" >
            @csrf

            @method('PUT')
            @include('administrador.marca.componentes.formulario')
        </form>
    </section>

@endsection