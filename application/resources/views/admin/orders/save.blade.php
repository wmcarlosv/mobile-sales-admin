@extends('adminlte::page')

@section('title', $title)

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
                {!! Form::open(['route' => 'orders.store', 'method' => 'POST', 'autocomplete' => 'off', 'files' => true]) !!}
            @else
                {!! Form::open(['route' => ['orders.update',$data->id], 'method' => 'PUT', 'autocomplete' => 'off', 'files' => true]) !!}
            @endif
                <ul class="nav nav-tabs">
                  <li class="active"><a data-toggle="tab" href="#order">Orden</a></li>
                  <li><a data-toggle="tab" href="#detail">Detalle</a></li>
                </ul>

                <div class="tab-content">
                  <div id="order" class="tab-pane fade in active">
                    <br />
                    <div class="form-group">
                        <label for="order_number">Numero de Orden: </label>
                        <input type="text" name="order_number" id="order_number" class="form-control" value="{{ @$data->order_number }}" />
                    </div>
                  </div>
                  <div id="detail" class="tab-pane fade">
                    <br />
                  </div>
                </div>
                <button class="btn btn-success"><i class="fa fa-floppy-o"></i> Guardar</button>
                <a class="btn btn-danger" href="{{ route('orders.index') }}"><i class="fa fa-times"></i> Cancelar</a>
            {!! Form::close() !!}
        </div>
    </div>
@stop