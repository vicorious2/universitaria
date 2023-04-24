<?php

namespace App\Http\Controllers;

use App\Models\Nivel;
use Illuminate\Http\Request;

class NivelController extends Controller
{
    public function getAllNiveles()
    {
        return Nivel::all();
    }

    public function index()
    {
        $datos['datosResult'] = Nivel::all();
        return view('nivel/nivel',$datos);
    }

    public function store(Request $request)
    {
        $datos = $request->except('_token');
        Nivel::insert($datos);
        return redirect('nivel')->with('Mensaje','Registro insertado!');
    }

    public function show($id)
    {
        $datos['registro'] = Nivel::findOrFail($id);
        return view('nivel/nivelShow',$datos);
    }

    public function edit($id)
    {
        $datos['registro'] = Nivel::findOrFail($id);
        return view('nivel/nivelEdit',$datos);
    }

    public function update(Request $request, $id)
    {
        $datos = $request->except(['_token','_method']);
        Nivel::where('id_nivel','=',$id)->update($datos);
        return redirect('nivel')->with('Mensaje','Registro Actualizado!');
    }

    public function destroy($id)
    {
        $delete = Nivel::destroy($id);
        return redirect('nivel')->with('Mensaje','Registro Eliminado!');
    }
}
