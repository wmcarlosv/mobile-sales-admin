<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\Customer;
use App\Product;
use DB;

class OrdersController extends Controller
{
    private $folder = 'admin.orders.';
    private $base_route = 'orders.index';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "Ordenes";
        $data = Order::all();
        return view($this->folder.'index',['title' => $title, 'data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "Nuevo Registro";
        $action = "new";
        $customers = Customer::all();
        $products = Product::all();
        return view($this->folder.'save',['title' => $title, 'action' => $action, 'customers' => $customers, 'products' => $products]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'order_number' => 'required|unique:orders',
            'order_date' => 'required',
            'customer_id' => 'required',
            'tax' => 'required',
            'discount' => 'required',
            'transport' => 'required',
            'subtotal' => 'required',
            'total' => 'required'
        ]);

        DB::beginTransaction();

        $object = new Order();
        $object->order_number = strtoupper($request->input('order_number'));
        $object->order_date = date('Y-m-d',strtotime($request->input('order_date')));
        $object->customer_id = $request->input('customer_id');
        $object->note = strtoupper($request->input('note'));
        $object->tax = $request->input('tax');
        $object->discount = $request->input('discount');
        $object->transport = $request->input('transport');
        $object->subtotal = $request->input('subtotal');
        $object->total = $request->input('total');

        //detalle
        $product = $request->input('product');
        $qty = $request->input('qty');
        $price_unit = $request->input('price_unit');
        $total_line = $request->input('total_line');

        $cont_error = 0;

        if($object->save()){
            for($i=0; $i < count($product); $i++){
                if( $object->products()->attach([
                        $product[$i] => [
                            'qty' => $qty[$i],
                            'price_unit' => $price_unit[$i],
                            'total_line' => $total_line[$i]
                        ]
                    ]))
                {
                    $cont_error++;
                }
            }
            
        }else{
            $cont_error++;  
        }

        if($cont_error > 0){
            DB::rollBack();
            flash()->overlay('Error al tratar de registrar los Datos!!','Error!!');
        }else{
            DB::commit();
            flash()->overlay('Datos registrados con Exito!!','Exito!!');
        }

        return redirect()->route($this->base_route);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $title = "Actualizar Registro";
        $action = "update";
        $customers = Customer::all();
        $products = Product::all();
        $data = Order::findorfail($id);

        return view($this->folder.'save',['title' => $title,'action' => $action, 'data' => $data, 'customers' => $customers, 'products' => $products]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'order_number' => 'required|unique:orders,order_number,'.$id,
            'order_date' => 'required',
            'customer_id' => 'required',
            'tax' => 'required',
            'discount' => 'required',
            'transport' => 'required',
            'subtotal' => 'required',
            'total' => 'required'
        ]);

        DB::beginTransaction();
        $object = Order::findorfail($id);
        $object->order_number = strtoupper($request->input('order_number'));
        $object->order_date = date('Y-m-d',strtotime($request->input('order_date')));
        $object->customer_id = $request->input('customer_id');
        $object->note = strtoupper($request->input('note'));
        $object->tax = $request->input('tax');
        $object->discount = $request->input('discount');
        $object->transport = $request->input('transport');
        $object->subtotal = $request->input('subtotal');
        $object->total = $request->input('total');

        //detalle
        $product = $request->input('product');
        $qty = $request->input('qty');
        $price_unit = $request->input('price_unit');
        $total_line = $request->input('total_line');

        $cont_error = 0;

        if($object->save()){
            $object->products()->detach();
            for($i=0; $i < count($product); $i++){
                if( $object->products()->attach([
                        $product[$i] => [
                            'qty' => $qty[$i],
                            'price_unit' => $price_unit[$i],
                            'total_line' => $total_line[$i]
                        ]
                    ]))
                {
                    $cont_error++;
                }
            }
            
        }else{
            $cont_error++;  
        }

        if($cont_error > 0){
            DB::rollBack();
            flash()->overlay('Error al tratar de modificar los Datos!!','Error!!');
        }else{
            DB::commit();
            flash()->overlay('Datos modificados con Exito!!','Exito!!');
        }

        return redirect()->route($this->base_route);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $object = Order::findorfail($id);
        if($object->delete()){
            flash()->overlay('Registro Eliminado con Exito!!','Exito!!');
        }else{
            flash()->overlay('Error al tratar de Eliminar el Registro!!','Error!!');
        }
        return redirect()->route($this->base_route);
    }
}
