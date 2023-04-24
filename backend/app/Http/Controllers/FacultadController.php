<?php

namespace App\Http\Controllers;

use App\Models\Facultad;
use Illuminate\Http\Request;

class FacultadController extends Controller
{
    public function getAllFacultas()
    {
        return Facultad::all();
    }

    public function index()
    {
        $datos['datosResult'] = Facultad::all();
        return view('facultad/facultad',$datos);
    }

    public function store(Request $request)
    {
        $datos = $request->except('_token');
       Facultad::insert($datos);
        return redirect('facultad')->with('Mensaje','Registro insertado!');
    }

    public function show($id)
    {
        $datos['registro'] =Facultad::findOrFail($id);
        return view('facultad/facultadShow',$datos);
    }

    public function edit($id)
    {
        $datos['registro'] =Facultad::findOrFail($id);
        return view('facultad/facultadEdit',$datos);
    }

    public function update(Request $request, $id)
    {
        $datos = $request->except(['_token','_method']);
       Facultad::where('id_facultad','=',$id)->update($datos);
        return redirect('facultad')->with('Mensaje','Registro Actualizado!');
    }

    public function destroy($id)
    {
        $delete =Facultad::destroy($id);
        return redirect('facultad')->with('Mensaje','Registro Eliminado!');
    }
}
