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
            @if($action == 'new')
                {!! Form::open(['route' => 'products.store', 'method' => 'POST', 'autocomplete' => 'off', 'files' => true]) !!}
            @else
                {!! Form::open(['route' => ['products.update',$data->id], 'method' => 'PUT', 'autocomplete' => 'off', 'files' => true]) !!}
            @endif
                <div class="form-group">
                    <label for="code">Codigo: </label>
                    <input type="text" name="code" id="code" class="form-control" value="{{ @$data->code }}" />
                </div>
                <div class="form-group">
                    <label for="name">Nombre: </label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ @$data->name }}" />
                </div>
                <div class="form-group">
                    <label for="bar_code">Codigo de Barras: </label>
                    <input type="text" name="bar_code" id="bar_code" class="form-control" value="{{ @$data->bar_code }}" />
                </div>
                <div class="form-group">
                    <label for="description">Descripción: </label>
                    <textarea name="description" id="description" class="form-control"> {{ @$data->description }}</textarea>
                </div>
                <div class="form-group">
                    <label for="price_unit">Precio Unitaro: </label>
                    <input type="text" name="price_unit" id="price_unit" class="form-control" value="{{ @$data->price_unit }}" />
                </div>
                <div class="form-group">
                    <label for="price_cost">Precio de Costo: </label>
                    <input type="text" name="price_cost" id="price_cost" class="form-control" value="{{ @$data->price_cost }}" />
                </div>
                <div class="form-group">
                    <label for="avatar">Avatar: </label>
                    @if($action == 'update')
                        @if(!empty(@$data->avatar))
                            <img class="img-thumbnail" width="300" height="300" src="{{ asset('application/storage/app/'.@$data->avatar) }}">
                        @endif
                    @endif
                    <input type="file" name="avatar" id="avatar" class="form-control" />
                </div>
                <button class="btn btn-success"><i class="fa fa-floppy-o"></i> Guardar</button>
                <a class="btn btn-danger" href="{{ route('products.index') }}"><i class="fa fa-times"></i> Cancelar</a>
            {!! Form::close() !!}
        </div>
    </div>
@stop