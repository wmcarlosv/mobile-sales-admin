<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;

class UsersController extends Controller
{
    private $folder = 'admin.users.';
    private $base_route = 'users.index';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "Vendedores";
        $data = User::where('role','=','seller')->get();
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
            'name' => 'required',
            'email' => 'required',
            'seller_code' => 'required'
        ]);

        $object = new User();
        $object->name = strtoupper($request->input('name'));
        $object->email = strtoupper($request->input('email'));
        $object->role = 'seller';
        $object->seller_code = strtoupper($request->input('seller_code'));
        $object->password = bcrypt($request->input('seller_code'));

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
        $data = User::findorfail($id);

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
            'name' => 'required',
            'email' => 'required',
            'seller_code' => 'required'
        ]);

        $object = User::findorfail($id);
        $object->name = strtoupper($request->input('name'));
        $object->email = strtoupper($request->input('email'));
        $object->role = 'seller';
        $object->seller_code = strtoupper($request->input('seller_code'));
        $object->password = bcrypt($request->input('seller_code'));

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
        $object = User::findorfail($id);
        if($object->delete()){
            flash()->overlay('Registro Eliminado con Exito!!','Exito!!');
        }else{
            flash()->overlay('Error al tratar de eliminar el Registro!!','Error!!');
        }
        return redirect()->route($this->base_route);
    }

    public function profile()
    {
        $title = 'Perfil';
        $data = User::findorfail(Auth::user()->id);
        return view($this->folder.'profile',['title' => $title,'data' => $data]);
    }

    public function update_profile(Request $request){

        $request->validate([
            'name' => 'required',
            'email' => 'required'
        ]);

        $object = User::findorfail(Auth::user()->id);
        $object->name = strtoupper($request->input('name'));
        $object->email = strtoupper($request->input('email'));

        if($object->save()){
            flash()->overlay('Perfil Actualizado con Exito','Exito!!');
        }else{
            flash()->overlay('Error al tratar de Actualizar el Perfil','Error!!');
        }

        return redirect()->route('home');
    }

    public function update_password(Request $request){
        $request->validate([
            'password' => 'required|confirmed'
        ]);

        $object = User::findorfail(Auth::user()->id);
        $object->password = bcrypt($request->input('password'));

        if($object->save()){
            flash()->overlay('Perfil Actualizado con Exito','Exito!!');
        }else{
            flash()->overlay('Error al tratar de Actualizar el Perfil','Error!!');
        }

        return redirect()->route('home');
    }
}
