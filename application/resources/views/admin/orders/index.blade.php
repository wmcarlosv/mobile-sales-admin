@extends('adminlte::page')

@section('title', $title)

@section('content')
    @include('flash::message')
    <div class="panel panel-default">

        <div class="panel-heading">
            <h2>{{ $title }}</h2>
        </div>
        <div class="panel-body">
            <a class="btn btn-success" href="{{ route('orders.create') }}"><i class="fa fa-plus"></i> Nuevo</a>
            <br />
            <br />
                <table class="table table-bordered table-striped data-table">
                    <thead>
                        <th>ID</th>
                        <th>Numero de Orden</th>
                        <th>Fecha de la Orden</th>
                        <th>Cliente</th>
                        <th>Total</th>
                        <th>/</th>
                    </thead>
                    <tbody>
                        @foreach($data as $d)
                            <tr>
                                <td>{{ $d->id }}</td>
                                <td>{{ $d->order_number }}</td>
                                <td>{{ date('d-m-Y',strtotime($d->order_date)) }}</td>
                                <td>{{ $d->customer->full_name }}</td>
                                <td>{{ $d->total }}</td>
                                <td>
                                    <a href="{{ route('orders.edit',$d->id) }}" class="btn btn-info"><i class="fa fa-pencil"></i></a>
                                    {!! Form::open(['route' => ['orders.destroy',$d->id], 'method' => 'DELETE', 'autocomplete' => 'off', 'style' => 'display:inline;']) !!}
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

            if(!confirm('Estas seguro de eliminar este registro?')){
                return false;
            }

        });
    });
</script>
@stop