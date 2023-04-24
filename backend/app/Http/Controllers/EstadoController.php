<?php

namespace App\Http\Controllers;

use App\Models\Estado;
use Illuminate\Http\Request;

class EstadoController extends Controller
{
    public function getAllEstados()
    {
        return Estado::all();
    }
    
    public function index()
    {
        $datos['datosResult'] = Estado::all();
        return view('estado/estado',$datos);
    }

    public function store(Request $request)
    {
        $datos = $request->except('_token');
        Estado::insert($datos);
        return redirect('estado')->with('Mensaje','Registro insertado!');
    }

    public function show($id)
    {
        $datos['registro'] =Estado::findOrFail($id);
        return view('estado/estadoShow',$datos);
    }

    public function edit($id)
    {
        $datos['registro'] =Estado::findOrFail($id);
        return view('estado/estadoEdit',$datos);
    }

    public function update(Request $request, $id)
    {
        $datos = $request->except(['_token','_method']);
        Estado::where('id_estado','=',$id)->update($datos);
        return redirect('estado')->with('Mensaje','Registro Actualizado!');
    }

    public function destroy($id)
    {
        $delete = Estado::destroy($id);
        return redirect('estado')->with('Mensaje','Registro Eliminado!');
    }
}
