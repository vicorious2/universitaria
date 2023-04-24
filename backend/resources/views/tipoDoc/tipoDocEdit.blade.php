@extends('layouts.master')

@section('title', 'Tipo Documento / Editar ')

@section('content')

<br>

<div style="width: 85%">

    {!!Form::open(['route'=>['tipoDoc.update',$registro->id_tipo_doc], 'method'=>'PUT'])!!}
        {{ csrf_field() }}
        {{ method_field('PATCH') }}
        <div class="form-group" style="width: 50%">
            <label for="nombre">Tipo</label>
            <input type="text" class="form-control" id="tipo_doc" name="tipo_doc" maxlength="2" value="{{ $registro->tipo_doc }}" required>
            <label for="nombre">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $registro->nombre }}" required>
        <br>
        <div style="text-align: right">
            <button type="button" class="btn btn-secondary" onclick="location.href='{{ route('tipoDoc.index') }}'">Cancelar</button>
            <button type="submit" class="btn btn-success">Editar</button>
        </div>
        </div>
    {!!Form::close()!!}

</div>
<br>
<br>

@endsection
