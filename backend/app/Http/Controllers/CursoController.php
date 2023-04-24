<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use App\Models\Usuario;
use App\Models\Estado;
use App\Models\Facultad;
use App\Models\Nivel;
use App\Models\Categoria;
use App\Models\CursoCategoria;
use Illuminate\Http\Request;

use DB;

class CursoController extends Controller
{
    public function getAllCursos()
    {
        return Curso::all();
    }
    
    public function index()
    {   
        $datos['datosResult'] = Curso::join('usuario', 'curso.id_usuario_p', '=', 'usuario.id_usuario')
                                        ->join('facultad', 'curso.id_facultad', '=', 'facultad.id_facultad')
                                        ->join('estado', 'curso.id_estado', '=', 'estado.id_estado')
                                        ->join('nivel', 'curso.id_nivel', '=', 'nivel.id_nivel')
                                        ->select(DB::raw("curso.*,usuario.nombre as profesor,facultad.nombre as facultad,
                                        estado.nombre as estado,nivel.nombre as nivel,
                                        (select group_concat(c.nombre separator '|')
                                            from categoria c
                                            inner join curso_categoria cc on c.id_categoria = cc.id_categoria
                                            where cc.id_curso = curso.id_curso ) as categorias,
                                        (select count(*) from clase where clase.id_curso = curso.id_curso) as clases"
                                        ))
                                        ->get();
        
        $listFacultad = Facultad::pluck('nombre', 'id_facultad');
        $listNivel = Nivel::pluck('nombre', 'id_nivel');
        $listCategoria = Categoria::pluck('nombre', 'id_categoria');
        $listUser = Usuario::where('id_tipo_usuario',2)->pluck('nombre','id_usuario');
        $listEstado = Estado::pluck('nombre', 'id_estado');

        return view('curso/curso',$datos)->with('listFacultad',$listFacultad)
                                            ->with('listUser',$listUser)
                                            ->with('listNivel',$listNivel)
                                            ->with('listCategoria',$listCategoria)
                                            ->with('listEstado',$listEstado);
    }

    public function store(Request $request)
    {
        $datos = $request->except('_token');

        $cursoModel = new Curso;
        $cursoModel->nombre = $request['nombre'];
        $cursoModel->descripcion = $request['descripcion'];
        $cursoModel->id_usuario_p = $request['id_usuario_p'];
        $cursoModel->id_facultad = $request['id_facultad'];
        $cursoModel->id_estado = $request['id_estado'];
        $cursoModel->id_nivel = $request['id_nivel'];
        $cursoModel->save();
        $last_insert_id = $cursoModel->id_curso;

        if($last_insert_id) {
           
            $categorias = explode(",", $request['id_categoria']);
           
            foreach ($categorias as $categoria) {
            
                $cursoCatModel = new CursoCategoria;
                $cursoCatModel->id_curso = $last_insert_id;
                $cursoCatModel->id_categoria = $categoria;
                $cursoCatModel->save();
            }
        }
        return redirect('curso')->with('Mensaje','Registro insertado!');
    }

    public function crearCurso(Request $request)
    {
        $datos = $request->except('_token');

        $cursoModel = new Curso;
        $cursoModel->nombre = $request['nombre'];
        $cursoModel->descripcion = $request['descripcion'];
        $cursoModel->id_usuario_p = $request['id_usuario_p'];
        $cursoModel->id_facultad = $request['id_facultad'];
        $cursoModel->id_estado = $request['id_estado'];
        $cursoModel->id_nivel = $request['id_nivel'];
        $cursoModel->save();
        $last_insert_id = $cursoModel->id_curso;

        if($last_insert_id) {
           
            $categorias = explode(",", $request['id_categoria']);
           
            foreach ($categorias as $categoria) {
            
                $cursoCatModel = new CursoCategoria;
                $cursoCatModel->id_curso = $last_insert_id;
                $cursoCatModel->id_categoria = $categoria;
                $cursoCatModel->save();
            }
        }
        return [
            'data' => 'Exitoso'
        ];
    }

    public function show($id)
    {
        $datos['registro'] = Curso::join('usuario', 'curso.id_usuario_p', '=', 'usuario.id_usuario')
                                    ->join('facultad', 'curso.id_facultad', '=', 'facultad.id_facultad')
                                    ->join('estado', 'curso.id_estado', '=', 'estado.id_estado')
                                    ->join('nivel', 'curso.id_nivel', '=', 'nivel.id_nivel')
                                    ->select(DB::raw("curso.*,usuario.nombre as profesor,facultad.nombre as facultad,
                                    estado.nombre as estado,nivel.nombre as nivel,
                                    (select group_concat(c.nombre)
                                        from categoria c
                                        inner join curso_categoria cc on c.id_categoria = cc.id_categoria
                                        where cc.id_curso = curso.id_curso ) as categorias"
                                    ))
                                    ->findOrFail($id);
        
        return view('curso/cursoShow',$datos);
    }

    public function edit($id)
    {
        $datos['registro'] = Curso::join('usuario', 'curso.id_usuario_p', '=', 'usuario.id_usuario')
                                    ->join('facultad', 'curso.id_facultad', '=', 'facultad.id_facultad')
                                    ->join('estado', 'curso.id_estado', '=', 'estado.id_estado')
                                    ->join('nivel', 'curso.id_nivel', '=', 'nivel.id_nivel')
                                    ->select(DB::raw("curso.*,usuario.nombre as profesor,facultad.nombre as facultad,
                                    estado.nombre as estado,nivel.nombre as nivel,
                                    (select group_concat(cc.id_categoria)
                                        from curso_categoria cc
                                        where cc.id_curso = curso.id_curso ) as categorias"
                                    ))
                                    ->findOrFail($id);

        $listFacultad = Facultad::pluck('nombre', 'id_facultad');
        $listNivel = Nivel::pluck('nombre', 'id_nivel');
        $listCategoria = Categoria::pluck('nombre', 'id_categoria');
        $listUser = Usuario::where('id_tipo_usuario',2)->pluck('nombre','id_usuario');
        $listEstado = Estado::pluck('nombre', 'id_estado');
        
        return view('curso/cursoEdit',$datos)->with('listFacultad',$listFacultad)
                                                ->with('listUser',$listUser)
                                                ->with('listNivel',$listNivel)
                                                ->with('listCategoria',$listCategoria)
                                                ->with('listEstado',$listEstado);
    }

    public function update(Request $request, $id)
    {
        $datos = $request->except(['_token','_method','id_categoria_ant','id_categoria']);

        $categoriasAnt = explode(",", $request['id_categoria_ant']);
        $categorias = explode(",", $request['id_categoria']);
        $diffmenos = array_filter(array_diff($categoriasAnt, $categorias));
        $diffmas = array_filter(array_diff($categorias, $categoriasAnt));

        if(!empty($diffmenos)){

            $deleteCursoCat = CursoCategoria::where('id_curso',$id)->whereIn('id_categoria', $diffmenos)->delete();
            if ($deleteCursoCat < 1) {
                return redirect('curso')->withErrors('EL REGISTRO NO PUDO SER ELIMINADO!');
            }
        }

        if(!empty($diffmas)){

            foreach ($diffmas as $categoria) {
            
                $cursoCatModel = new CursoCategoria;
                $cursoCatModel->id_curso = $id;
                $cursoCatModel->id_categoria = $categoria;
                $cursoCatModel->save();
            }
        }
        Curso::where('id_curso','=',$id)->update($datos);
        return redirect('curso')->with('Mensaje','Registro Actualizado!');
    }

    public function destroy($id)
    {
        $deleteCursoCat = CursoCategoria::where('id_curso',$id)->delete();

        if ($deleteCursoCat >= 1) {
            $delete = Curso::destroy($id);
            return redirect('curso')->with('Mensaje','Registro Eliminado!');
        }else{
            return redirect('curso')->withErrors('EL REGISTRO NO PUDO SER ELIMINADO!');
        }        
    }
}
