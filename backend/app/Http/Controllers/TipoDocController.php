<?php

namespace App\Http\Controllers;

use App\Models\TipoDoc;
use Illuminate\Http\Request;

class TipoDocController extends Controller
{
    public function getAllTypeUser()
    {
        return TipoDoc::all();
    }
    
    public function index()
    {
        $datos['datosResult'] = TipoDoc::all();
        return view('tipoDoc/tipoDoc',$datos);
    }

    public function store(Request $request)
    {
        $datos = $request->except('_token');
        TipoDoc::insert($datos);
        return redirect('tipoDoc')->with('Mensaje','Registro insertado!');
    }

    public function show($id)
    {
        $datos['registro'] =TipoDoc::findOrFail($id);
        return view('tipoDoc/tipoDocShow',$datos);
    }

    public function edit($id)
    {
        $datos['registro'] =TipoDoc::findOrFail($id);
        return view('tipoDoc/tipoDocEdit',$datos);
    }

    public function update(Request $request, $id)
    {
        $datos = $request->except(['_token','_method']);
        TipoDoc::where('id_tipo_doc','=',$id)->update($datos);
        return redirect('tipoDoc')->with('Mensaje','Registro Actualizado!');
    }

    public function destroy($id)
    {
        $delete =TipoDoc::destroy($id);
        return redirect('tipoDoc')->with('Mensaje','Registro Eliminado!');
    }
}
