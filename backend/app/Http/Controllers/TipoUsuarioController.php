<?php

namespace App\Http\Controllers;

use App\Models\TipoUsuario;
use Illuminate\Http\Request;

class TipoUsuarioController extends Controller
{   
    public function getAllTypeUser()
    {
        return TipoUsuario::whereNotIn('id_tipo_usuario', [1] )->get();;
    }
    
    public function index()
    {
        $datos['datosResult'] = TipoUsuario::all();
        return view('tipoUsuario/tipoUsuario',$datos);
    }

    public function store(Request $request)
    {
        $datos = $request->except('_token');
        TipoUsuario::insert($datos);
        return redirect('tipoUsuario')->with('Mensaje','Registro insertado!');
    }

    public function show($id)
    {
        $datos['registro'] =TipoUsuario::findOrFail($id);
        return view('tipoUsuario/tipoUsuarioShow',$datos);
    }

    public function edit($id)
    {
        $datos['registro'] =TipoUsuario::findOrFail($id);
        return view('tipoUsuario/tipoUsuarioEdit',$datos);
    }

    public function update(Request $request, $id)
    {
        // $datos = $request->except(['_token','_method']);
        // TipoUsuario::where('id_tipo_usuario','=',$id)->update($datos);
        return redirect('tipoUsuario')->with('Mensaje','Registro Actualizado!');
    }

    public function destroy($id)
    {
        // $delete =TipoUsuario::destroy($id);
        return redirect('tipoUsuario')->with('Mensaje','Registro Eliminado!');
    }
}
