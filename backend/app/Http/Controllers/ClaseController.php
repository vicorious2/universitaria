<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use App\Models\Clase;
use App\Models\TipoRecurso;
use App\Models\Recurso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use DB;

class ClaseController extends Controller
{
    public function getAllClases()
    {
        return Clase::all();
    }

    public function index()
    {
        $datos['datosResult'] = Clase::join('curso', 'clase.id_curso', '=', 'curso.id_curso')
                                        ->select(DB::raw("clase.*, curso.nombre as curso,
                                        (select count(r.id_recurso)
                                            from recurso r
                                            where r.id_clase = clase.id_clase
                                        ) as cant"
                                        ))
                                        ->orderBy('clase.id_curso', 'asc')
                                        ->orderBy('clase.orden', 'asc')
                                        ->get();

        $listTipoRecurso = TipoRecurso::pluck('nombre', 'id_tipo_recurso');
        $listCurso = Curso::pluck('nombre', 'id_curso');

        return view('clase/clase',$datos)->with('listTipoRecurso',$listTipoRecurso)
                                            ->with('listCurso',$listCurso);
    }


    public function store(Request $request)
    {
        $datos = $request->except('_token');
        $request->validate([
                'documentClase' => 'file|mimes:txt,doc,docx,pdf,xls,xlsx|max:2048',
                'videoClase' => 'required|mimetypes:video/mp4,video/avi,video/mpeg,video/quicktime|max:102400'
        ]);
        // 'miniaturaClase' => 'mimes:jpeg,png,jpg,gif|max:2048',
        $lastOrder = Clase::where('id_curso',$request['id_curso'])->max('orden');
        $orden = 1;
        if($lastOrder){
            $orden = ++$lastOrder;
        }

        $claseModel = new Clase;
        $claseModel->nombre = $request['nombre'];
        $claseModel->descripcion = $request['descripcion'];
        $claseModel->id_curso = $request['id_curso'];
        $claseModel->orden = $orden;
        $claseModel->save();
        $last_insert_id = $claseModel->id_clase;

        // Carga de archivos Amazon S3
        // if($request->file() && $last_insert_id) {
        
        //     $folderS3 = 'curso'.$request['id_curso'].'/clase'.$last_insert_id;

        //     if($request->file('videoClase')){
        //         // save in Amazon S3 Video
        //         $uploadedVideo = $request->file('videoClase');
        //         $fileNameVideo = $uploadedVideo->getClientOriginalName();
        //         $filePathVideo = Storage::disk('s3')->put($folderS3, $uploadedVideo, 'public');
        //         //save in database Video
        //         $recursoVideoModel = new Recurso;
        //         $recursoVideoModel->nombre = $fileNameVideo;
        //         $recursoVideoModel->ruta = $filePathVideo;
        //         $recursoVideoModel->id_tipo_recurso =1;
        //         $recursoVideoModel->id_clase = $last_insert_id;
        //         $recursoVideoModel->save();
        //     }

        //     // if($request->file('miniaturaClase')){
        //     //     //save in Amazon S3 Image
        //     //     $uploadedImage = $request->file('miniaturaClase');
        //     //     $fileNameImage = $uploadedImage->getClientOriginalName();
        //     //     $filePathImage = Storage::disk('s3')->put($folderS3, $uploadedImage, 'public');
        //     //     //save in database Image
        //     //     $recursoImageModel = new Recurso;
        //     //     $recursoImageModel->nombre = $fileNameImage;
        //     //     $recursoImageModel->ruta = $filePathImage;
        //     //     $recursoImageModel->id_tipo_recurso =2;
        //     //     $recursoImageModel->id_clase = $last_insert_id;
        //     //     $recursoImageModel->save();
        //     // }

        //     if($request->file('documentClase')){
        //         //save in Amazon S3 Pdf
        //         $uploadedPdf = $request->file('documentClase');
        //         $fileNamePdf = $uploadedPdf->getClientOriginalName();
        //         $filePathPdf = Storage::disk('s3')->put($folderS3, $uploadedPdf, 'public');
        //         //save in database Pdf
        //         $recursoPdfModel = new Recurso;
        //         $recursoPdfModel->nombre = $fileNamePdf;
        //         $recursoPdfModel->ruta = $filePathPdf;
        //         $recursoPdfModel->id_tipo_recurso =3;
        //         $recursoPdfModel->id_clase = $last_insert_id;
        //         $recursoPdfModel->save();
        //     }
        // }
        
        // Carga de archivos local storage
        if($request->file() && $last_insert_id) {

            if($request->file('videoClase')){
                //save in local storage Video
                $uploadedVideo = $request->file('videoClase');
                $fileNameVideo = $uploadedVideo->getClientOriginalName();
                $filePathVideo = $uploadedVideo->storeAs('curso'.$request['id_curso'].'/clase'.$last_insert_id, $fileNameVideo, 'public');
                //save in database Video
                $recursoVideoModel = new Recurso;
                $recursoVideoModel->nombre = $fileNameVideo;
                $recursoVideoModel->ruta = $filePathVideo;
                $recursoVideoModel->id_tipo_recurso =1;
                $recursoVideoModel->id_clase = $last_insert_id;
                $recursoVideoModel->save();
            }

            // if($request->file('miniaturaClase')){
            //     //save in local storage Image
            //     $uploadedImage = $request->file('miniaturaClase');
            //     $fileNameImage = $uploadedImage->getClientOriginalName();
            //     $filePathImage = $uploadedImage->storeAs('curso'.$request['id_curso'].'/clase'.$last_insert_id, $fileNameImage, 'public');
            //     //save in database Image
            //     $recursoImageModel = new Recurso;
            //     $recursoImageModel->nombre = $fileNameImage;
            //     $recursoImageModel->ruta = $filePathImage;
            //     $recursoImageModel->id_tipo_recurso =2;
            //     $recursoImageModel->id_clase = $last_insert_id;
            //     $recursoImageModel->save();
            // }

            if($request->file('documentClase')){
                //save in local storage Pdf
                $uploadedPdf = $request->file('documentClase');
                $fileNamePdf = $uploadedPdf->getClientOriginalName();
                $filePathPdf = $uploadedPdf->storeAs('curso'.$request['id_curso'].'/clase'.$last_insert_id, $fileNamePdf, 'public');
                //save in database Pdf
                $recursoPdfModel = new Recurso;
                $recursoPdfModel->nombre = $fileNamePdf;
                $recursoPdfModel->ruta = $filePathPdf;
                $recursoPdfModel->id_tipo_recurso =3;
                $recursoPdfModel->id_clase = $last_insert_id;
                $recursoPdfModel->save();
            }
        }

        return redirect('clase')->with('Mensaje','Registro insertado!');
    }

    public function crearClase(Request $request)
    {
        $datos = $request->except('_token');
        $request->validate([
                'documentClase' => 'file|mimes:txt,doc,docx,pdf,xls,xlsx|max:2048',
                'videoClase' => 'required|mimetypes:video/mp4,video/avi,video/mpeg,video/quicktime|max:102400'
        ]);
        // 'miniaturaClase' => 'mimes:jpeg,png,jpg,gif|max:2048',
        $lastOrder = Clase::where('id_curso',$request['id_curso'])->max('orden');
        $orden = 1;
        if($lastOrder){
            $orden = ++$lastOrder;
        }

        $claseModel = new Clase;
        $claseModel->nombre = $request['nombre'];
        $claseModel->descripcion = $request['descripcion'];
        $claseModel->id_curso = $request['id_curso'];
        $claseModel->orden = $orden;
        $claseModel->save();
        $last_insert_id = $claseModel->id_clase;

        // Carga de archivos Amazon S3
        // if($request->file() && $last_insert_id) {
        
        //     $folderS3 = 'curso'.$request['id_curso'].'/clase'.$last_insert_id;

        //     if($request->file('videoClase')){
        //         // save in Amazon S3 Video
        //         $uploadedVideo = $request->file('videoClase');
        //         $fileNameVideo = $uploadedVideo->getClientOriginalName();
        //         $filePathVideo = Storage::disk('s3')->put($folderS3, $uploadedVideo, 'public');
        //         //save in database Video
        //         $recursoVideoModel = new Recurso;
        //         $recursoVideoModel->nombre = $fileNameVideo;
        //         $recursoVideoModel->ruta = $filePathVideo;
        //         $recursoVideoModel->id_tipo_recurso =1;
        //         $recursoVideoModel->id_clase = $last_insert_id;
        //         $recursoVideoModel->save();
        //     }

        //     // if($request->file('miniaturaClase')){
        //     //     //save in Amazon S3 Image
        //     //     $uploadedImage = $request->file('miniaturaClase');
        //     //     $fileNameImage = $uploadedImage->getClientOriginalName();
        //     //     $filePathImage = Storage::disk('s3')->put($folderS3, $uploadedImage, 'public');
        //     //     //save in database Image
        //     //     $recursoImageModel = new Recurso;
        //     //     $recursoImageModel->nombre = $fileNameImage;
        //     //     $recursoImageModel->ruta = $filePathImage;
        //     //     $recursoImageModel->id_tipo_recurso =2;
        //     //     $recursoImageModel->id_clase = $last_insert_id;
        //     //     $recursoImageModel->save();
        //     // }

        //     if($request->file('documentClase')){
        //         //save in Amazon S3 Pdf
        //         $uploadedPdf = $request->file('documentClase');
        //         $fileNamePdf = $uploadedPdf->getClientOriginalName();
        //         $filePathPdf = Storage::disk('s3')->put($folderS3, $uploadedPdf, 'public');
        //         //save in database Pdf
        //         $recursoPdfModel = new Recurso;
        //         $recursoPdfModel->nombre = $fileNamePdf;
        //         $recursoPdfModel->ruta = $filePathPdf;
        //         $recursoPdfModel->id_tipo_recurso =3;
        //         $recursoPdfModel->id_clase = $last_insert_id;
        //         $recursoPdfModel->save();
        //     }
        // }
        
        // Carga de archivos local storage
        if($request->file() && $last_insert_id) {

            if($request->file('videoClase')){
                //save in local storage Video
                $uploadedVideo = $request->file('videoClase');
                $fileNameVideo = $uploadedVideo->getClientOriginalName();
                $filePathVideo = $uploadedVideo->storeAs('curso'.$request['id_curso'].'/clase'.$last_insert_id, $fileNameVideo, 'public');
                //save in database Video
                $recursoVideoModel = new Recurso;
                $recursoVideoModel->nombre = $fileNameVideo;
                $recursoVideoModel->ruta = $filePathVideo;
                $recursoVideoModel->id_tipo_recurso =1;
                $recursoVideoModel->id_clase = $last_insert_id;
                $recursoVideoModel->save();
            }

            // if($request->file('miniaturaClase')){
            //     //save in local storage Image
            //     $uploadedImage = $request->file('miniaturaClase');
            //     $fileNameImage = $uploadedImage->getClientOriginalName();
            //     $filePathImage = $uploadedImage->storeAs('curso'.$request['id_curso'].'/clase'.$last_insert_id, $fileNameImage, 'public');
            //     //save in database Image
            //     $recursoImageModel = new Recurso;
            //     $recursoImageModel->nombre = $fileNameImage;
            //     $recursoImageModel->ruta = $filePathImage;
            //     $recursoImageModel->id_tipo_recurso =2;
            //     $recursoImageModel->id_clase = $last_insert_id;
            //     $recursoImageModel->save();
            // }

            if($request->file('documentClase')){
                //save in local storage Pdf
                $uploadedPdf = $request->file('documentClase');
                $fileNamePdf = $uploadedPdf->getClientOriginalName();
                $filePathPdf = $uploadedPdf->storeAs('curso'.$request['id_curso'].'/clase'.$last_insert_id, $fileNamePdf, 'public');
                //save in database Pdf
                $recursoPdfModel = new Recurso;
                $recursoPdfModel->nombre = $fileNamePdf;
                $recursoPdfModel->ruta = $filePathPdf;
                $recursoPdfModel->id_tipo_recurso =3;
                $recursoPdfModel->id_clase = $last_insert_id;
                $recursoPdfModel->save();
            }
        }

        return redirect('clase')->with('Mensaje','Registro insertado!');
    }

    public function show($id)
    {
        $datos['registro'] = Clase::join('curso', 'clase.id_curso', '=', 'curso.id_curso')
                                    ->select(DB::raw("clase.*, curso.nombre as curso,
                                    (select group_concat(rn.nombre separator '|')
                                        from recurso rn
                                            where rn.id_clase = clase.id_clase
                                    ) as list"
                                    ))
                                    ->findOrFail($id);
        return view('clase/claseShow',$datos);
    }

    public function edit($id)
    {
        $datos['registro'] = Clase::join('curso', 'clase.id_curso', '=', 'curso.id_curso')
                                    ->select(DB::raw("clase.*, curso.nombre as curso,
                                    (select group_concat(rn.nombre separator '|')
                                        from recurso rn
                                            where rn.id_clase = clase.id_clase
                                    ) as list"
                                    ))
                                    ->findOrFail($id);

        $listTipoRecurso = TipoRecurso::pluck('nombre', 'id_tipo_recurso');
        $listCurso = Curso::pluck('nombre', 'id_curso');
        
        return view('clase/claseEdit',$datos)->with('listTipoRecurso',$listTipoRecurso)
                                                ->with('listCurso',$listCurso);
    }

    public function update(Request $request, $id)
    {
        $datos = $request->except(['_token','_method']);
        Clase::where('id_clase','=',$id)->update($datos);
        return redirect('clase')->with('Mensaje','Registro Actualizado!');
    }

    public function destroy($id)
    {   
        $claseElim = Clase::select('id_curso','orden')->where('id_clase',$id)->get();
        $idCurso = $claseElim[0]['id_curso'];
        $ordenActual = $claseElim[0]['orden'];
        $clases = Clase::where('id_curso',$idCurso)->where('orden','>',$ordenActual)->orderBy('orden')->get();
        $recursos = Recurso::where('id_clase',$id)->get();

        //delete in Amazon S3
        foreach ($recursos as $recurso) {
            Storage::disk('s3')->delete($recurso->ruta);
        }
        //delete in database
        $deleteRecursos = Recurso::where('id_clase',$id)->delete();
        
        if ($deleteRecursos >= 1) {
            $deleteClase = Clase::destroy($id);
            foreach ($clases as $clase) {
                $newOrder = --$clase->orden;
                Clase::where('id_clase','=',$clase->id_clase)->update(array('orden' => $newOrder));
            }
            return redirect('clase')->with('Mensaje','Registro Eliminado!');
        }else{
            return redirect('clase')->withErrors('EL REGISTRO NO PUDO SER ELIMINADO!');
        }
    }

    public function getAllClassByCourse($id_curso)
    {
        $datos['listClass'] = Clase::where('id_curso',$id_curso)->orderBy('clase.orden', 'asc')->get();
        $datos['listOrders'] = Clase::select('id_clase','orden')->where('id_curso',$id_curso)->orderBy('clase.orden')->get();
        return response()->json($datos);
    }

    public function changeOrderClassByCourse(Request $request)
    {   
        $ordenActual = $request['ordenActual'];
        $ordenNuevo = $request['ordenNuevo'];
        $idCurso = $request['id_curso'];
        $idClase = $request['id_clase'];
        // Validar si el orden nuevo es mayor o menor al orden actual// ordenNuevo mayor Restar, ordenNuevoMenor Sumar 
        if($ordenNuevo > $ordenActual){
            $betweenFirst = $ordenActual;
            $betweenLast = $ordenNuevo;
            $accion = 'subtract';
        }else{
            $betweenFirst = $ordenNuevo;
            $betweenLast = $ordenActual;
            $accion = 'add';
        }
        $clases = Clase::select('id_curso','id_clase','nombre','orden')
                            ->where('id_curso',$idCurso)
                            ->whereBetween('orden', [$betweenFirst, $betweenLast])
                            ->where('id_clase','<>',$idClase)
                            ->orderBy('orden')
                            ->get();

        if($accion == 'subtract'){
            foreach ($clases as $clase) {
                $newOrder = --$clase->orden;
                Clase::where('id_clase','=',$clase->id_clase)->update(array('orden' => $newOrder));
            }
        }else{
            foreach ($clases as $clase) {
                $newOrder = ++$clase->orden;
                Clase::where('id_clase','=',$clase->id_clase)->update(array('orden' => $newOrder));
            }
        }

        Clase::where('id_clase','=',$idClase)->update(array('orden' => $ordenNuevo));

    }
}
