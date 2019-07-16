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
                {!! Form::open(['route' => 'users.store', 'method' => 'POST', 'autocomplete' => 'off']) !!}
            @else
                {!! Form::open(['route' => ['users.update',$data->id], 'method' => 'PUT', 'autocomplete' => 'off']) !!}
            @endif
                <div class="form-group">
                    <label for="name">Nombre: </label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ @$data->name }}" />
                </div>
                <div class="form-group">
                    <label for="email">Correo: </label>
                    <input type="text" name="email" id="email" class="form-control" value="{{ @$data->email }}" />
                </div>
                <div class="input-group">
                    <input type="text" placeholder="Codigo Vendedor" readonly="readonly" name="seller_code" id="seller_code" class="form-control" value="{{ @$data->seller_code }}" />
                    <div class="input-group-btn">
                        <button type="button" class="btn btn-success" id="generate_code">Generar Codigo</button>
                    </div>
                </div>
                <br />
                <div class="form-group">
                    <label for="device_id">ID de Dispositivo: </label>
                    <input type="text" readonly="readonly" name="device_id" id="device_id" class="form-control" value="{{ @$data->device_id }}" />
                </div>
                <button class="btn btn-success"><i class="fa fa-floppy-o"></i> Guardar</button>
                <a class="btn btn-danger" href="{{ route('users.index') }}"><i class="fa fa-times"></i> Cancelar</a>
            {!! Form::close() !!}
        </div>
    </div>
@stop
@section('js')
<script type="text/javascript">
    $(document).ready(function(){
        $("#generate_code").click(function(){
           var result           = '';
           var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
           var charactersLength = characters.length;
           var length = 8;
           for ( var i = 0; i < length; i++ ) {
              result += characters.charAt(Math.floor(Math.random() * charactersLength));
           }
           $("#seller_code").val(result);
       });
    });
</script>
@stop