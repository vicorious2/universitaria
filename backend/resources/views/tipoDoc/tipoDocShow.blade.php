@extends('layouts.master')

@section('title', 'Tipo Documento / Consultar ')

@section('content')

<br>

<div style="width: 85%">

    <form>
        <fieldset disabled>
        <div class="form-group" style="width: 50%">
            <label for="nombre">Tipo</label>
            <input type="text" class="form-control" id="tipo_doc" name="tipo_doc" maxlength="2" value="{{ $registro->tipo_doc }}">
            <label for="nombre">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $registro->nombre }}">
        <br>
        </div>
        </fieldset>
        <button type="button" class="btn btn-primary" onclick="location.href='{{ route('tipoDoc.edit',$registro->id_tipo_doc) }}'">Editar</button>
    </form>

</div>
<br>
<br>

@endsection
