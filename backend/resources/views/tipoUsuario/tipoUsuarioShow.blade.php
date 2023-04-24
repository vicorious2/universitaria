@extends('layouts.master')

@section('title', 'Tipo Usuario / Consultar ')

@section('content')

<br>

<div style="width: 85%">

    <form>
        <fieldset disabled>
        <div class="form-group" style="width: 50%">
            <label for="nombre">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $registro->nombre }}">
        <br>
        </div>
        </fieldset>
        <button type="button" class="btn btn-primary" onclick="location.href='{{ route('tipoUsuario.edit',$registro->id_tipo_usuario) }}'">Editar</button>
    </form>

</div>
<br>
<br>

@endsection
