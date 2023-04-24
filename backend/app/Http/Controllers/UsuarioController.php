<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Models\Estado;
use App\Models\TipoUsuario;
use App\Models\TipoDoc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    public function index()
    {
        $datos['datosResult'] = Usuario::join('tipo_doc', 'usuario.id_tipo_doc', '=', 'tipo_doc.id_tipo_doc')
                                        ->join('tipo_usuario', 'usuario.id_tipo_usuario', '=', 'tipo_usuario.id_tipo_usuario')
                                        ->join('estado', 'usuario.id_estado', '=', 'estado.id_estado')
                                        ->select('usuario.*','tipo_doc.nombre as tipo_doc','tipo_usuario.nombre as tipo_usuario', 'estado.nombre as estado')
                                        ->get();

        $listTipoDoc = TipoDoc::pluck('nombre', 'id_tipo_doc');
        $listTipoUser = TipoUsuario::pluck('nombre', 'id_tipo_usuario');
        $listEstado = Estado::pluck('nombre', 'id_estado');

        return view('usuario/usuario',$datos)->with('listTipoDoc',$listTipoDoc)
                                            ->with('listTipoUser',$listTipoUser)
                                            ->with('listEstado',$listEstado);
    }

    public function store(Request $request)
    {
        $datos = $request->except('_token');
        
        $usuarioModel = new Usuario;
        $usuarioModel->documento = $request['documento'];
        $usuarioModel->nombre = $request['nombre'];
        $usuarioModel->correo = $request['correo'];
        $usuarioModel->telefono = $request['telefono'];
        $usuarioModel->password = Hash::make('iudc'.$request['documento']);
        $usuarioModel->id_tipo_usuario = $request['id_tipo_usuario'];
        $usuarioModel->id_tipo_doc = $request['id_tipo_doc'];
        $usuarioModel->id_estado = $request['id_estado'];
        $usuarioModel->save();

        return redirect('usuario')->with('Mensaje','Registro insertado!');
    }

    public function show($id)
    {
        $datos['registro'] = Usuario::join('tipo_doc', 'usuario.id_tipo_doc', '=', 'tipo_doc.id_tipo_doc')
                                    ->join('tipo_usuario', 'usuario.id_tipo_usuario', '=', 'tipo_usuario.id_tipo_usuario')
                                    ->join('estado', 'usuario.id_estado', '=', 'estado.id_estado')
                                    ->select('usuario.*','tipo_doc.nombre as tipo_doc','tipo_usuario.nombre as tipo_usuario', 'estado.nombre as estado')
                                    ->findOrFail($id);

        return view('usuario/usuarioShow',$datos);
    }

    public function edit($id)
    {
        $datos['registro'] = Usuario::join('tipo_doc', 'usuario.id_tipo_doc', '=', 'tipo_doc.id_tipo_doc')
                                        ->join('tipo_usuario', 'usuario.id_tipo_usuario', '=', 'tipo_usuario.id_tipo_usuario')
                                        ->join('estado', 'usuario.id_estado', '=', 'estado.id_estado')
                                        ->select('usuario.*','tipo_doc.nombre as tipo_doc','tipo_usuario.nombre as tipo_usuario', 'estado.nombre as estado')
                                        ->findOrFail($id);

        $listTipoDoc = TipoDoc::pluck('nombre', 'id_tipo_doc');
        $listTipoUser = TipoUsuario::pluck('nombre', 'id_tipo_usuario');
        $listEstado = Estado::pluck('nombre', 'id_estado');
        
        return view('usuario/usuarioEdit',$datos)->with('listTipoDoc',$listTipoDoc)
                                                ->with('listTipoUser',$listTipoUser)
                                                ->with('listEstado',$listEstado);
    }

    public function update(Request $request, $id)
    {
        $datos = $request->except(['_token','_method']);
        Usuario::where('id_usuario','=',$id)->update($datos);
        return redirect('usuario')->with('Mensaje','Registro Actualizado!');
    }

    public function destroy($id)
    {
        $delete = Usuario::destroy($id);
        return redirect('usuario')->with('Mensaje','Registro Eliminado!');
    }

    public function resetPass($id, $documento){
        $newPass = Hash::make('iudc'.$documento);
        Usuario::where('id_usuario','=',$id)->update(array('password' => $newPass));
        return redirect('usuario')->with('Mensaje','Registro Actualizado!');
    }
}
