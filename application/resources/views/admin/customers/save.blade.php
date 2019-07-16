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
                {!! Form::open(['route' => 'customers.store', 'method' => 'POST', 'autocomplete' => 'off']) !!}
            @else
                {!! Form::open(['route' => ['customers.update',$data->id], 'method' => 'PUT', 'autocomplete' => 'off']) !!}
            @endif
                <div class="form-group">
                    <label for="dni">DNI: </label>
                    <input type="text" name="dni" id="dni" class="form-control" value="{{ @$data->dni }}" />
                </div>
                <div class="form-group">
                    <label for="full_name">Nombre: </label>
                    <input type="text" name="full_name" id="full_name" class="form-control" value="{{ @$data->full_name }}" />
                </div>
                <div class="form-group">
                    <label for="email">Email: </label>
                    <input type="text" name="email" id="email" class="form-control" value="{{ @$data->email }}" />
                </div>
                <div class="form-group">
                    <label for="phone">Telefono: </label>
                    <input type="text" name="phone" id="phone" class="form-control" value="{{ @$data->phone }}" />
                </div>
                <div class="form-group">
                    <label for="city">Ciudad: </label>
                    <input type="text" name="city" id="city" class="form-control" value="{{ @$data->city }}" />
                </div>
                <div class="form-group">
                    <label for="address">Dirección: </label>
                    <input type="text" name="address" id="address" class="form-control" value="{{ @$data->address }}" />
                </div>
                <div class="form-group">
                    <label for="note">Nota: </label>
                    <textarea name="note" id="note" class="form-control">{{ @$data->note }}</textarea> 
                </div>
                <button class="btn btn-success"><i class="fa fa-floppy-o"></i> Guardar</button>
                <a class="btn btn-danger" href="{{ route('customers.index') }}"><i class="fa fa-times"></i> Cancelar</a>
            {!! Form::close() !!}
        </div>
    </div>
@stop