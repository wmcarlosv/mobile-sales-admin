@extends('adminlte::page')

@section('title', $title)

@section('content')
    @include('flash::message')
    <div class="panel panel-default">

        <div class="panel-heading">
            <h2>{{ $title }}</h2>
        </div>
        <div class="panel-body">
            <a class="btn btn-success" href="{{ route('customers.create') }}"><i class="fa fa-plus"></i> Nuevo</a>
            <br />
            <br />
                <table class="table table-bordered table-striped data-table">
                    <thead>
                        <th>ID</th>
                        <th>DNI</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Telefono</th>
                        <th>Ciudad</th>
                        <th>Dirección</th>
                        <th>Estatus</th>
                        <th>/</th>
                    </thead>
                    <tbody>
                        @foreach($data as $d)
                            <tr>
                                <td>{{ $d->id }}</td>
                                <td>{{ $d->dni }}</td>
                                <td>{{ $d->full_name }}</td>
                                <td>{{ $d->email }}</td>
                                <td>{{ $d->phone }}</td>
                                <td>{{ $d->city }}</td>
                                <td>{{ $d->address }}</td>
                                <td>
                                    @if($d->status == 'active')
                                        <label class="label label-success">Activo</label>
                                    @else
                                        <label class="label label-danger">Inactivo</label>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('customers.edit',$d->id) }}" class="btn btn-info"><i class="fa fa-pencil"></i></a>
                                    {!! Form::open(['route' => ['customers.destroy',$d->id], 'method' => 'DELETE', 'autocomplete' => 'off', 'style' => 'display:inline;']) !!}
                                        @if($d->status == 'active')
                                            <button class="btn btn-danger delete-record"><i class="fa fa-times"></i></button>
                                        @else
                                            <button class="btn btn-success delete-record"><i class="fa fa-check"></i></button>
                                        @endif
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