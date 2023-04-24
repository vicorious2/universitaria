@extends('layouts.master')

@section('title', 'Gestion Usuarios / Consultar ')

@section('content')

<br>

<div style="width: 85%">

    <form>
        <fieldset disabled>
        <div class="form-group" style="width: 50%">
            
        <label for="id_tipo_usuario">Tipo Usuario</label>
        <input type="text" class="form-control" id="id_tipo_usuario" name="id_tipo_usuario" value="{{$registro->tipo_usuario}}">

        <label for="id_tipo_doc">Tipo Documento</label>
        <input type="text" class="form-control" id="id_tipo_doc" name="id_tipo_doc" value="{{$registro->tipo_doc}}">

        <label for="documento">Documento</label>
        <input type="text" class="form-control" id="documento" name="documento" value="{{$registro->documento}}">
        
        <label for="nombre">Nombres y Apellidos</label>
        <input type="text" class="form-control" id="nombre" name="nombre" value="{{$registro->nombre}}">

        <label for="correo">Correo</label>
        <input type="text" class="form-control" id="correo" name="correo" value="{{$registro->correo}}">

        <label for="telefono">Telefono</label>
        <input type="text" class="form-control" id="telefono" name="telefono" value="{{$registro->telefono}}">

        <label for="id_estado">Estado</label>
        <input type="text" class="form-control" id="id_estado" name="id_estado" value="{{$registro->estado}}">

        <br>
        </div>
        </fieldset>
        <button type="button" class="btn btn-primary" onclick="location.href='{{ route('usuario.edit',$registro->id_usuario) }}'">Editar</button>
    </form>

</div>
<br>
<br>

@endsection
