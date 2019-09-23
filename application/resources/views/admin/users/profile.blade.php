@extends('adminlte::page')

@section('title', $title)

@section('css')
<style type="text/css">
    input, select, textarea{
        text-transform: uppercase !important;
    }
</style>
@stop

@section('content')
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="panel panel-default">
        <div class="panel-heading">
            <h2>{{ $title }}</h2>
        </div>
        <div class="panel-body">
            {!! Form::open(['route' => 'update-profile', 'method' => 'PUT', 'autocomplete' => 'off']) !!}
                <div class="form-group">
                    <label for="name">Nombre: </label>
                    <input class="form-control" value="{{ $data->name }}" name="name" id="name" type="text" />
                </div>
                <div class="form-group">
                    <label for="email">Email: </label>
                    <input class="form-control" value="{{ $data->email }}"  name="email" id="email" type="text" />
                </div>
                <button class="btn btn-success"><i class="fa fa-pencil"></i> Actualizar</button>
            {!! Form::close() !!}
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h2>Cambiar Contrase&ntilde;a</h2>
        </div>
        <div class="panel-body">
            {!! Form::open(['route' => 'update-password', 'method' => 'PUT', 'autocomplete' => 'off']) !!}
                <div class="form-group">
                    <label for="password">Contrase&ntilde;a: </label>
                    <input class="form-control" name="password" id="password" type="password" />
                </div>
                <div class="form-group">
                    <label for="password_confirmation">Repite Contrase&ntilde;a: </label>
                    <input class="form-control" name="password_confirmation" id="password_confirmation" type="password" />
                </div>
                <button class="btn btn-success"><i class="fa fa-pencil"></i> Actualizar</button>
                <a class="btn btn-danger" href='{{ route("home") }}'><i class="fa fa-times"></i> Cancelar</a>
            {!! Form::close() !!}
        </div>
    </div>
@stop