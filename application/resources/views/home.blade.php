@extends('adminlte::page')

@section('title', $title)

@section('content_header')
    <h1>{{ $title }}</h1>
@stop

@section('content')
     @include('flash::message')
    <div class="row">
    	<div class="col-md-4">
    		<div class="info-box">
			  <!-- Apply any bg-* class to to the icon to color it -->
			  <span class="info-box-icon bg-red"><i class="fa fa-money"></i></span>
			  <div class="info-box-content">
			    <span class="info-box-text">Vendedores</span>
			    <span class="info-box-number">{{ $sellers->count() }}</span>
			  </div>
			  <!-- /.info-box-content -->
			</div>
			<!-- /.info-box -->
    	</div>

    	<div class="col-md-4">
    		<div class="info-box">
			  <!-- Apply any bg-* class to to the icon to color it -->
			  <span class="info-box-icon bg-blue"><i class="fa fa-users"></i></span>
			  <div class="info-box-content">
			    <span class="info-box-text">Clientes</span>
			    <span class="info-box-number">{{ $customers->count() }}</span>
			  </div>
			  <!-- /.info-box-content -->
			</div>
			<!-- /.info-box -->
    	</div>

    	<div class="col-md-4">
    		<div class="info-box">
			  <!-- Apply any bg-* class to to the icon to color it -->
			  <span class="info-box-icon bg-green"><i class="fa fa-list"></i></span>
			  <div class="info-box-content">
			    <span class="info-box-text">Ordenes</span>
			    <span class="info-box-number">{{ $orders->count() }}</span>
			  </div>
			  <!-- /.info-box-content -->
			</div>
			<!-- /.info-box -->
    	</div>
    </div>

    <div class="row">
    	<div class="col-md-6">
    		<div class="panel panel-default">
    			<div class="panel-heading">
    				<h2>Ultimos Clientes Registrados</h2>
    			</div>
    			<div class="panel-body">
    				<table class="table table-bordered table-striped">
                        <thead>
                            <th>ID</th>
                            <th>DNI</th>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Telefono</th>
                        </thead>
                        <tbody>
                            @foreach($customers as $c)
                                <tr>
                                    <td>{{ $c->id }}</td>
                                    <td>{{ $c->dni }}</td>
                                    <td>{{ $c->full_name }}</td>
                                    <td>{{ $c->email }}</td>
                                    <td>{{ $c->phone }}</td>
                                </tr>
                            @endforeach
                        </tbody>        
                    </table>
    			</div>
    		</div>
    	</div>

    	<div class="col-md-6">
    		<div class="panel panel-default">
    			<div class="panel-heading">
    				<h2>Ultimas Ordenes Realizadas</h2>
    			</div>
    			<div class="panel-body">
    				<table class="table table-bordered table-striped">
                        <thead>
                            <th>ID</th>
                            <th>Numero</th>
                            <th>Cliente</th>
                            <th>Fecha</th>
                            <th>Monto</th>
                        </thead>
                        <tbody>
                            @foreach($orders as $or)
                                <tr>
                                    <td>{{ $or->id }}</td>
                                    <td>{{ $or->order_number }}</td>
                                    <td>{{ $or->customer->full_name }}</td>
                                    <td>{{ $or->order_date }}</td>
                                    <td>{{ $or->total }}</td>
                                </tr>
                            @endforeach
                        </tbody>     
                    </table>
    			</div>
    		</div>
    	</div>
    </div>
@stop
@section('js')
<script type="text/javascript">
    $(document).ready(function(){
        $('#flash-overlay-modal').modal();
    });
</script>
@stop