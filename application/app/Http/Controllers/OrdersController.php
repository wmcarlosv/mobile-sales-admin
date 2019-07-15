<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;

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
        return view($this->folder.'save',['title' => $title, 'action' => $action]);
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
            'order_number' => 'required',
            'order_date' => 'required',
            'customer_id' => 'required',
            'tax' => 'required',
            'discount' => 'required',
            'transport' => 'required',
            'total' => 'required'
        ]);

        $object = new Order();
        $object->order_number = $request->input('order_number');

        if($object->save()){
            flash()->overlay('Datos registrados con Exito!!','Exito!!');
        }else{
            flash()->overlay('Error al tratar de registrar los Datos!!','Error!!');
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
        $data = Order::findorfail($id);

        return view($this->folder.'save',['title' => $title,'action' => $action, 'data' => $data]);
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
            'order_number' => 'required',
            'order_date' => 'required',
            'customer_id' => 'required',
            'tax' => 'required',
            'discount' => 'required',
            'transport' => 'required',
            'total' => 'required'
        ]);

        $object = Order::findorfail($id);
        $object->order_number = $request->input('order_number');

        if($object->update()){
            flash()->overlay('Datos actualizados con Exito!!','Exito!!');
        }else{
            flash()->overlay('Error al tratar de actualizar los Datos!!','Error!!');
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
