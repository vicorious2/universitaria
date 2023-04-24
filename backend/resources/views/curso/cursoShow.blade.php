@extends('layouts.master')

@section('title', 'Gestion Cursos / Consultar ')

@section('content')

<br>

<div style="width: 85%">

    <form>
        <fieldset disabled>
        <div class="form-group" style="width: 50%">
        
        <label for="nombre">Nombre</label>
        <input type="text" class="form-control" id="nombre" name="nombre"  value="{{$registro->nombre}}">

        <label for="descripcion">Descripcion</label>
        <input type="text" class="form-control" id="descripcion" name="descripcion"  value="{{$registro->descripcion}}">

        <label for="id_usuario_p">Profesor</label>
        <input type="text" class="form-control" id="id_usuario_p" name="id_usuario_p"  value="{{$registro->profesor}}">

        <label for="id_facultad">Facultad</label>
        <input type="text" class="form-control" id="id_facultad" name="id_facultad"  value="{{$registro->facultad}}">
        
        <label for="id_nivel">Nivel</label>
        <input type="text" class="form-control" id="id_nivel" name="id_nivel"  value="{{$registro->nivel}}">

        <label for="id_categoria">Categorias</label>
        <input type="text" class="form-control" id="id_categoria" name="id_categoria"  value="{{$registro->categorias}}">

        <label for="id_estado">Estado</label>
        <input type="text" class="form-control" id="id_estado" name="id_estado"  value="{{$registro->estado}}">

        <br>
        </div>
        </fieldset>
        <button type="button" class="btn btn-primary" onclick="location.href='{{ route('curso.edit',$registro->id_curso) }}'">Editar</button>
    </form>

</div>
<br>
<br>

@endsection
