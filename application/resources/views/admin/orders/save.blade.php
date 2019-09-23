@extends('adminlte::page')

@section('title', $title)

@section('css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css" rel="stylesheet" />
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
                {!! Form::open(['route' => 'orders.store', 'method' => 'POST', 'autocomplete' => 'off', 'files' => true]) !!}
            @else
                {!! Form::open(['route' => ['orders.update',$data->id], 'method' => 'PUT', 'autocomplete' => 'off', 'files' => true]) !!}
            @endif
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="order_number">Numero de Orden: </label>
                            <input type="text" name="order_number" id="order_number" class="form-control" value="{{ @$data->order_number }}" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="order_date">Fecha de Orden: </label>
                            @if($action == 'new')
                                <input type="date" name="order_date" id="order_date" class="form-control" value="{{ date('Y-m-d') }}" />
                            @else
                                <input type="date" name="order_date" id="order_date" class="form-control" value="{{ @$data->order_date }}" />
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="customer_id">Cliente: </label>
                            <select style="width: 100% !important;" class="form-control simple-select" name="customer_id" id="customer_id">
                                <option>-</option>
                               @foreach($customers as $c)
                                @if(@$data->customer_id == $c->id)
                                    <option value='{{ $c->id }}' selected="selected">{{ $c->full_name }}</option>
                                @else
                                    <option value='{{ $c->id }}'>{{ $c->full_name }}</option>
                                @endif
                               @endforeach 
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="note">Nota: </label>
                            <textarea class="form-control" name="note" id="note">{{ @$data->note }}</textarea>
                        </div>
                    </div>
                </div>
                <h3>Productos</h3>
                <hr />
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <th>Producto</th>
                                <th>Cantidad</th>
                                <th>Precio Unitario</th>
                                <th>Total Linea</th>
                                <th>/</th>
                            </thead>
                            <tbody id="load-content">
                                <tr>
                                    <td>
                                        <select id="product" class="form-control simple-select">
                                            <option value="">-</option>
                                            @foreach($products as $p)
                                                <option data-price="{{ $p->price_unit }}" value='{{ $p->id }}'>{{ $p->name }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <input type="number" id="qty" min="1" value="1" class="form-control">
                                    </td>
                                    <td>
                                        <input type="text" id="price_unit" readonly="readonly" class="form-control">
                                    </td>
                                    <td>
                                        <input type="text" id="total_line" readonly="readonly" class="form-control">
                                    </td>
                                    <td>
                                        <button class="btn btn-success" type="button" id="add-product"><i class="fa fa-plus"></i></button>
                                    </td>
                                </tr>
                                @if(@$data->products)
                                    @foreach(@$data->products as $de)
                                        <tr>
                                            <td><input type='hidden' name='product[]' value='{{ $de->id }}'/>{{ $de->name }}</td>
                                            <td><input type='hidden' name='qty[]' value='{{ $de->pivot->qty }}'/>{{ $de->pivot->qty }}</td>
                                            <td><input type='hidden' name='price_unit[]' value='{{ $de->pivot->price_unit }}'/>{{ $de->pivot->price_unit }}</td>
                                            <td><input type='hidden' name='total_line[]' value='{{ $de->pivot->total_line }}'/>{{ $de->pivot->total_line }}</td>
                                            <td>
                                                <button type='button' class='btn btn-danger delete-product-row'><i class='fa fa-times'></i> </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
                
                <div class="row">
                    <table class="table table-bordred table-striped">
                        <tbody>
                            <tr>
                                <td width="70%" align="right"><b>Sub Total:</b></td>
                                <td width="30%"><input type="text" readonly="readonly" name="subtotal" id="subtotal" class="form-control" value="{{ @$data->subtotal|0 }}" /></td>
                            </tr>
                            <tr>
                                <td width="70%" align="right"><b>Impuesto:</b></td>
                                <td width="30%"><input type="text" name="tax" id="tax" class="form-control" value="{{ @$data->tax|0 }}" /></td>
                            </tr>
                            <tr>
                                <td width="70%" align="right"><b>Descuento:</b></td>
                                <td width="30%"><input type="text" name="discount" id="discount" class="form-control" value="{{ @$data->discount|0 }}" /></td>
                            </tr>
                            <tr>
                                <td width="70%" align="right"><b>Transporte:</b></td>
                                <td width="30%"><input type="text" name="transport" id="transport" class="form-control" value="{{ @$data->transport|0 }}" /></td>
                            </tr>
                            <tr>
                                <td width="70%" align="right"><b>Total:</b></td>
                                <td width="30%"><input type="text" readonly="readonly" name="total" id="total" class="form-control" value="{{ @$data->total|0 }}" /></td>
                            </tr>
                        </tbody>
                    </table>
                </div>                
            </div>
            <button class="btn btn-success"><i class="fa fa-floppy-o"></i> Guardar</button>
            <a class="btn btn-danger" href="{{ route('orders.index') }}"><i class="fa fa-times"></i> Cancelar</a>
            {!! Form::close() !!}
        </div>
    </div>
@stop
@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('select.simple-select').select2();
        $("#add-product").click(function(){
            var id = $("#product").val();
            var product_name =  $("#product option:selected").text();
            var product_price_unit = $("#product option:selected").attr('data-price');
            var cantidad = $("#qty").val();
            var total = parseFloat(product_price_unit) * parseFloat(cantidad);
            var record = "<tr>";
                    record+="<td><input type='hidden' name='product[]' value='"+id+"'/>"+product_name+"</td>";
                    record+="<td><input type='hidden' name='qty[]' value='"+cantidad+"'/>"+cantidad+"</td>";
                    record+="<td><input type='hidden' name='price_unit[]' value='"+product_price_unit+"'/>"+product_price_unit+"</td>";
                     record+="<td><input type='hidden' name='total_line[]' value='"+total+"'/>"+total+"</td>";
                     record+="<td><button type='button' class='btn btn-danger delete-product-row'><i class='fa fa-times'></i> </button></td>";
                record+="</tr>";

            if(id && cantidad && product_price_unit){
                $("#load-content").append(record);
            }else{
                alert("Debes ingresar los datos del producto!!");
            }

            record = "";
            $("#product").val("");
            $("#qty").val("");
            $("#price_unit").val("");
            $("#total_line").val("");
            update_subtotal();
            update_total();
        });

        $("#product").change(function(){
            var precio = parseFloat($("#product option:selected").attr('data-price'));
            $("#price_unit").val(precio);
        });


        $("#qty").focusout(function(){
            var qty = parseInt($(this).val());
            var precio = parseFloat($("#product option:selected").attr('data-price'));
            var total = (precio*qty)
            $("#total_line").val(total);
        });

        $("#qty").change(function(){
            var qty = parseInt($(this).val());
            var precio = parseFloat($("#product option:selected").attr('data-price'));
            var total = (precio*qty)
            $("#total_line").val(total);
        });

        $("body").on('click','button.delete-product-row', function(){
            $(this).parent().parent().remove();
            update_subtotal();
            update_total();
        });

        $("#tax, #discount, #transport").focusout(function(){
            update_total();
        });
    });

    function update_subtotal(){
        var total = 0;
        var sub_totales = document.getElementsByName('total_line[]');
        var cantidad = sub_totales.length;
        if(cantidad > 0){
            for(var i = 0;i < cantidad; i++){
                total+=parseFloat(sub_totales[i].value);
            }
        }else{
            $("#tax, #discount, #transport").val("");
        }
        
        $("#subtotal").val(total);
    }

    function update_total(){

        var subtotal = parseFloat($("#subtotal").val());
        var impuesto = parseFloat($("#tax").val());
        var descuento = parseFloat($("#discount").val());
        var transporte = parseFloat($("#transport").val());
        var tax = 0;
        var discount = 0;
        var grand_total = 0;

        if(descuento){
            discount = (subtotal * descuento) / 100;
            subtotal = (subtotal - discount);
        }

        if(impuesto){
            tax = (subtotal * impuesto) / 100;
        }

        if(!transporte){
            transporte = 0;
        }

        grand_total = (subtotal+tax+transporte);
        $("#total").val(grand_total);
    }
</script>
@stop