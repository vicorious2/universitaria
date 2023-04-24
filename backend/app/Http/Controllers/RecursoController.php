<?php

namespace App\Http\Controllers;

use App\Models\Recurso;
use Illuminate\Http\Request;
use Storage;

class RecursoController extends Controller
{
    public function getResourceForIdClass($id_clase)
    {
        $datos['listResource'] = Recurso::join('tipo_recurso', 'recurso.id_tipo_recurso', '=', 'tipo_recurso.id_tipo_recurso')
                                        ->select('recurso.id_recurso as id_recurso','recurso.nombre as recurso','recurso.ruta as ruta','tipo_recurso.nombre as tipo')
                                        ->where('recurso.id_clase', '=', $id_clase)
                                        ->get();
        return response()->json($datos);
    }

    public function getResourceDownload($id_recurso){

        $datos['registro'] =Recurso::findOrFail($id_recurso);
        if(Storage::disk('public')->exists($datos['registro']['ruta'])){
            return Storage::disk('public')->download($datos['registro']['ruta']);
        }else{
            return redirect('clase')->withErrors('Documento no encontrado!');
        }
    }
}
