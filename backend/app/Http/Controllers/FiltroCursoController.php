<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Facultad;
use App\Models\Nivel;
use App\Models\Categoria;
use App\Models\Curso;
use App\Models\Clase;
use App\Models\UsuarioCurso;
use \stdClass;
use DB;

class FiltroCursoController extends Controller
{
    public function getFilterCourse(Request $request){

        $listFacultad = Facultad::all('nombre', 'id_facultad');
        $listNivel = Nivel::all('nombre', 'id_nivel');
        $listCategoria = Categoria::all('nombre', 'id_categoria');

        $filters = new stdClass;
        $filters->niveles = $listNivel;
        $filters->categorias = $listCategoria;
        $filters->areas = $listFacultad;

        return $filters;
    }

    public function getAllCourse(){
        
        $listCursos = Curso::join('usuario', 'curso.id_usuario_p', '=', 'usuario.id_usuario')
                            ->join('facultad', 'curso.id_facultad', '=', 'facultad.id_facultad')
                            ->join('estado', 'curso.id_estado', '=', 'estado.id_estado')
                            ->join('nivel', 'curso.id_nivel', '=', 'nivel.id_nivel')
                            ->select(DB::raw("curso.*,usuario.nombre as profesor,facultad.nombre as facultad,
                            estado.nombre as estado,nivel.nombre as nivel, LEFT(curso.descripcion, 250) as short_descript,
                            (select group_concat(c.nombre separator ' - ')
                                from categoria c
                                inner join curso_categoria cc on c.id_categoria = cc.id_categoria
                                where cc.id_curso = curso.id_curso ) as categorias"
                            ))
                            ->where('curso.id_estado',1)
                            ->orderBy('curso.fecha', 'asc')
                            ->get();
        return $listCursos;
    }

    public function getNewCourse(){

        $listCursos = Curso::select(DB::raw("curso.*,LEFT(curso.descripcion, 150) as short_descript"))
                            ->where('curso.id_estado',1)
                            ->orderBy('curso.fecha', 'desc')
                            ->limit(4)
                            ->get();
        return $listCursos;
    }


    public function registerInCourse(Request $request){
       
        $usuarioCursoModel = new UsuarioCurso;
        $usuarioCursoModel->id_curso = $request->id_curso;
        $usuarioCursoModel->id_usuario = $request->id_usuario;
        $usuarioCursoModel->save();
        $last_insert_id = $usuarioCursoModel->id_usuario_curso;

        return $last_insert_id;
        
    }

    public function getAllCourseRegister($idUsuario){
        
        return UsuarioCurso::join('curso', 'usuario_curso.id_curso', '=', 'curso.id_curso')
                            ->select(DB::raw("usuario_curso.*, curso.nombre as 'curso',
                            (select count(*) from clase where clase.id_curso = usuario_curso.id_curso) as cant_clase"))
                            ->where('usuario_curso.id_usuario',$idUsuario)
                            ->get();
    }

    public function getAllClassCourse($idCurso){
        
        
        $listClases = Clase::where('clase.id_curso',$idCurso)
                            ->orderBy('clase.orden', 'asc')
                            ->get();
        return $listClases;
    }

    public function getfirstClassCourse($idCurso){

        return Clase::join('curso', 'clase.id_curso', '=', 'curso.id_curso')
                    ->select(DB::raw("clase.*, curso.nombre as curso,
                    (select r.nombre from recurso r where r.id_clase = clase.id_clase and r.id_tipo_recurso = 1) as nombre_video,
                    (select r.ruta from recurso r where r.id_clase = clase.id_clase and r.id_tipo_recurso = 1) as ruta_video,
                    (select r.nombre from recurso r where r.id_clase = clase.id_clase and r.id_tipo_recurso = 3) as nombre_doc,
                    (select r.ruta from recurso r where r.id_clase = clase.id_clase and r.id_tipo_recurso = 3) as ruta_doc
                    "))
                    ->where('clase.id_curso',$idCurso)
                    ->first();
    }

    public function getClassCourse($idCurso, $idClase){
        
        return Clase::join('curso', 'clase.id_curso', '=', 'curso.id_curso')
                    ->select(DB::raw("clase.*, curso.nombre as curso,
                    (select r.nombre from recurso r where r.id_clase = clase.id_clase and r.id_tipo_recurso = 1) as nombre_video,
                    (select r.ruta from recurso r where r.id_clase = clase.id_clase and r.id_tipo_recurso = 1) as ruta_video,
                    (select r.nombre from recurso r where r.id_clase = clase.id_clase and r.id_tipo_recurso = 3) as nombre_doc,
                    (select r.ruta from recurso r where r.id_clase = clase.id_clase and r.id_tipo_recurso = 3) as ruta_doc
                    "))
                    ->where('clase.id_curso',$idCurso)
                    ->where('clase.id_clase',$idClase)
                    ->first();
    }
    
}
