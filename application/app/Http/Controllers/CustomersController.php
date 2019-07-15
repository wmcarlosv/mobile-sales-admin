<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;

class CustomersController extends Controller
{
    private $folder = 'admin.customers.';
    private $base_route = 'customers.index';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "Clientes";
        $data = Customer::all();
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
            'dni' => 'required',
            'full_name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'city' => 'required',
            'address' => 'required'
        ]);

        $object = new Customer();
        $object->dni = $request->input('dni');
        $object->full_name = $request->input('full_name');
        $object->email = $request->input('email');
        $object->phone = $request->input('phone');
        $object->city = $request->input('city');
        $object->address = $request->input('address');
        $object->note = $request->input('note');

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
        $data = Customer::findorfail($id);

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
            'dni' => 'required',
            'full_name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'city' => 'required',
            'address' => 'required'
        ]);

        $object = Customer::findorfail($id);
        $object->dni = $request->input('dni');
        $object->full_name = $request->input('full_name');
        $object->email = $request->input('email');
        $object->phone = $request->input('phone');
        $object->city = $request->input('city');
        $object->address = $request->input('address');
        $object->note = $request->input('note');

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
        $object = Customer::findorfail($id);

        if($object->status == 'active'){
            $message = 'Registro Inactivado con Exito!!';
            $object->status = 'inactive';
        }else{
            $message = 'Registro activado con Exito!!';
             $object->status = 'active';
        }

        if($object->update()){
            flash()->overlay($message,'Exito!!');
        }else{
            flash()->overlay('Error al tratar de activar o desactivar el Registro!!','Error!!');
        }
        return redirect()->route($this->base_route);
    }
}
