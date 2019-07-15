@extends('adminlte::page')

@section('title', $title)

@section('content')
    @include('flash::message')
    <div class="panel panel-default">

        <div class="panel-heading">
            <h2>{{ $title }}</h2>
        </div>
        <div class="panel-body">
            <a class="btn btn-success" href="{{ route('products.create') }}"><i class="fa fa-plus"></i> Nuevo</a>
            <br />
            <br />
                <table class="table table-bordered table-striped data-table">
                    <thead>
                        <th>ID</th>
                        <th>Codigo</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Precio Unitaro</th>
                        <th>Precio de Costo</th>
                        <th>Avatar</th>
                        <th>/</th>
                    </thead>
                    <tbody>
                        @foreach($data as $d)
                            <tr>
                                <td>{{ $d->id }}</td>
                                <td>{{ $d->code }}</td>
                                <td>{{ $d->name }}</td>
                                <td>{{ $d->description }}</td>
                                <td>{{ $d->price_unit }}</td>
                                <td>{{ $d->price_cost }}</td>
                                <td>
                                    @if(!empty($d->avatar))
                                        <img class="img-thumbnail" width="150" height="150" src="{{ asset('application/storage/app/'.$d->avatar) }}">
                                    @else
                                        <label class="label label-info">Sin Imagen</label>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('products.edit',$d->id) }}" class="btn btn-info"><i class="fa fa-pencil"></i></a>
                                    {!! Form::open(['route' => ['products.destroy',$d->id], 'method' => 'DELETE', 'autocomplete' => 'off', 'style' => 'display:inline;']) !!}
                                        <button class="btn btn-danger delete-record"><i class="fa fa-times"></i></button>

                                    {!! Form::close() !!}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            {!! Form::close() !!}
        </div>
    </div>
@stop
@section('js')
<script type="text/javascript">
    $(document).ready(function(){
        $('#flash-overlay-modal').modal();
        $('table.data-table').DataTable();
        $('body').on('click','button.delete-record', function(){

            if(!confirm('Estas seguro de activar o desactivar este registro?')){
                return false;
            }

        });
    });
</script>
@stop