<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function getAllCategorias()
    {
        return Categoria::all();
    }
    
    public function index()
    {
        $datos['datosResult'] = Categoria::all();
        return view('categoria/categoria',$datos);
    }

    public function store(Request $request)
    {
        $datos = $request->except('_token');
        Categoria::insert($datos);
        return redirect('categoria')->with('Mensaje','Registro insertado!');
    }

    public function show($id)
    {
        $datos['registro'] = Categoria::findOrFail($id);
        return view('categoria/categoriaShow',$datos);
    }

    public function edit($id)
    {
        $datos['registro'] = Categoria::findOrFail($id);
        return view('categoria/categoriaEdit',$datos);
    }

    public function update(Request $request, $id)
    {
        $datos = $request->except(['_token','_method']);
        Categoria::where('id_categoria','=',$id)->update($datos);
        return redirect('categoria')->with('Mensaje','Registro Actualizado!');
    }

    public function destroy($id)
    {
        $delete = Categoria::destroy($id);
        return redirect('categoria')->with('Mensaje','Registro Eliminado!');
    }
}
