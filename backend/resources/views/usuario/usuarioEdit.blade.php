@extends('layouts.master')

@section('title', 'Gestion Usuarios / Editar ')

@section('content')

<br>

<div style="width: 85%">

    {!!Form::open(['route'=>['usuario.update',$registro->id_usuario], 'method'=>'PUT'])!!}
        {{ csrf_field() }}
        {{ method_field('PATCH') }}
        <div class="form-group" style="width: 50%">

        <label for="id_tipo_usuario">Tipo Usuario</label>
        <select class="form-control" id="id_tipo_usuario" name="id_tipo_usuario" required>
            <option value="">
            @foreach ($listTipoUser as $key => $value)
                <option value="{{ $key }}" {{$registro->id_tipo_usuario == $key  ? 'selected' : ''}}> {{ $value }} </option>
            @endforeach
        </select>

        <label for="id_tipo_doc">Tipo Documento</label>
        <select class="form-control" id="id_tipo_doc" name="id_tipo_doc" required>
            <option value="">
            @foreach ($listTipoDoc as $key => $value)
                <option value="{{ $key }}" {{$registro->id_tipo_doc == $key  ? 'selected' : ''}}> {{ $value }} </option>
            @endforeach
        </select>

        <label for="documento">Documento</label>
        <input type="text" class="form-control" id="documento" name="documento" value="{{$registro->documento}}" required>
        
        <label for="nombre">Nombres y Apellidos</label>
        <input type="text" class="form-control" id="nombre" name="nombre" value="{{$registro->nombre}}" required>

        <label for="correo">Correo</label>
        <input type="text" class="form-control" id="correo" name="correo" value="{{$registro->correo}}" required>

        <label for="telefono">Telefono</label>
        <input type="text" class="form-control" id="telefono" name="telefono" value="{{$registro->telefono}}" required>

        <label for="id_estado">Estado</label>
        <select class="form-control" id="id_estado" name="id_estado" required>
            <option value="">
            @foreach ($listEstado as $key => $value)
                <option value="{{ $key }}" {{$registro->id_estado == $key  ? 'selected' : ''}}> {{ $value }} </option>
            @endforeach
        </select>

        
        <br>
        <div style="text-align: right">
            <button type="button" class="btn btn-secondary" onclick="location.href='{{ route('usuario.index') }}'">Cancelar</button>
            <button type="submit" class="btn btn-success">Editar</button>
        </div>
        </div>
    {!!Form::close()!!}

    <div style="text-align: left">
        {!!Form::open(['route'=>['resetPass',$registro->id_usuario, $registro->documento], 'style'=>'display:inline' ,'method'=>'POST'])!!}
            <button class="btn btn-info">Restablecer Contraseña</button>
        {!!Form::close()!!}
    </div>

</div>
<br>
<br>

@endsection
