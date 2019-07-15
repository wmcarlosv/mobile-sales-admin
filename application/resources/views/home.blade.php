@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Escritorio</h1>
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
			    <span class="info-box-number">0</span>
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
			    <span class="info-box-number">0</span>
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
			    <span class="info-box-number">0</span>
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
    				
    			</div>
    		</div>
    	</div>

    	<div class="col-md-6">
    		<div class="panel panel-default">
    			<div class="panel-heading">
    				<h2>Ultimas Ordenes Realizadas</h2>
    			</div>
    			<div class="panel-body">
    				
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