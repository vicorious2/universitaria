<?php

namespace App\Http\Controllers;

use App\Models\TipoRecurso;
use Illuminate\Http\Request;

class TipoRecursoController extends Controller
{
    public function getAllTipoRecurso()
    {
        return TipoRecurso::all();
    }
    
    public function index()
    {
        $datos['datosResult'] = TipoRecurso::all();
        return view('tipoRecurso/tipoRecurso',$datos);
    }

    public function store(Request $request)
    {
        $datos = $request->except('_token');
        TipoRecurso::insert($datos);
        return redirect('tipoRecurso')->with('Mensaje','Registro insertado!');
    }

    public function show($id)
    {
        $datos['registro'] =TipoRecurso::findOrFail($id);
        return view('tipoRecurso/tipoRecursoShow',$datos);
    }

    public function edit($id)
    {
        $datos['registro'] =TipoRecurso::findOrFail($id);
        return view('tipoRecurso/tipoRecursoEdit',$datos);
    }

    public function update(Request $request, $id)
    {
        $datos = $request->except(['_token','_method']);
        TipoRecurso::where('id_tipo_recurso','=',$id)->update($datos);
        return redirect('tipoRecurso')->with('Mensaje','Registro Actualizado!');
    }

    public function destroy($id)
    {
        $delete =TipoRecurso::destroy($id);
        return redirect('tipoRecurso')->with('Mensaje','Registro Eliminado!');
    }
}
