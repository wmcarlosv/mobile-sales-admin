<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Product;

class ProductsController extends Controller
{
    private $folder = 'admin.products.';
    private $base_route = 'products.index';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "Productos";
        $data = Product::all();
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
            'code' => 'required|unique:products',
            'name' => 'required',
            'description' => 'required',
            'price_unit' => 'required',
            'price_cost' => 'required',
            'bar_code' => 'required|unique:products'
        ]);

        $object = new Product();
        $object->code = $request->input('code');
        $object->name = $request->input('name');
        $object->bar_code = $request->input('bar_code');
        $object->description = $request->input('description');
        $object->price_unit = $request->input('price_unit');
        $object->price_cost = $request->input('price_cost');

        if($request->hasFile('avatar')){
            $object->avatar = $request->avatar->store('products');
        }else{
            $object->avatar = NULL;
        }

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
        $data = Product::findorfail($id);

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
            'code' => 'required|unique:products',
            'name' => 'required',
            'description' => 'required',
            'price_unit' => 'required',
            'price_cost' => 'required',
            'bar_code' => 'required|unique:products'
        ]);

        $object = Product::findorfail($id);
        $object->code = $request->input('code');
        $object->name = $request->input('name');
        $object->bar_code = $request->input('bar_code');
        $object->description = $request->input('description');
        $object->price_unit = $request->input('price_unit');
        $object->price_cost = $request->input('price_cost');
        if($request->hasFile('avatar')){
            Storage::delete($object->avatar);
            $object->avatar = $request->avatar->store('products');
        }

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
        $object = Product::findorfail($id);
        $image = $object->avatar;
        if($object->delete()){
            Storage::delete($image);
            flash()->overlay('Registro Eliminado con Exito!!','Exito!!');
        }else{
            flash()->overlay('Error al tratar de Eliminar el Registro!!','Error!!');
        }
        return redirect()->route($this->base_route);
    }
}
