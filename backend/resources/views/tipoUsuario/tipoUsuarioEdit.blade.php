@extends('layouts.master')

@section('title', 'Tipo Usuario / Editar ')

@section('content')

<br>

<div style="width: 85%">

    {!!Form::open(['route'=>['tipoUsuario.update',$registro->id_tipo_usuario], 'method'=>'PUT'])!!}
        {{ csrf_field() }}
        {{ method_field('PATCH') }}
        <div class="form-group" style="width: 50%">
            <label for="nombre">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $registro->nombre }}" required>
        <br>
        <div style="text-align: right">
            <button type="button" class="btn btn-secondary" onclick="location.href='{{ route('tipoUsuario.index') }}'">Cancelar</button>
            <button type="submit" class="btn btn-success">Editar</button>
        </div>
        </div>
    {!!Form::close()!!}

</div>
<br>
<br>

@endsection
