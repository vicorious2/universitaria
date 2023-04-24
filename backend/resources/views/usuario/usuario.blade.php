@extends('layouts.master')

@section('title', 'Gestion Usuarios')
@section('titleModal', 'Agregar Usuario')

@section('content')
<br>
    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addModal">Agregar</button>
<br>
<br>

<div style="width: 100%">
<table class="table table-hover table-bordered" id="table-listado" data-page-length='5'>
    <thead>
      <tr>
        <th scope="col">Id</th>
        <th scope="col">Tipo Doc</th>
        <th scope="col">Documento</th>
        <th scope="col">Nombre</th>
        <th scope="col">Correo</th>
        <th scope="col">Telefono</th>
        <th scope="col">Tipo Usuario</th>
        <th scope="col">Estado</th>
        <th scope="col">Acciones</th>
      </tr>
    </thead>
    <tbody>
    @foreach ($datosResult as $dato)
        <tr>
            <th scope="row">{{$dato->id_usuario}}</th>
            <td>{{$dato->tipo_doc}}</td>
            <td>{{$dato->documento}}</td>
            <td>{{$dato->nombre}}</td>
            <td>{{$dato->correo}}</td>
            <td>{{$dato->telefono}}</td>
            <td>{{$dato->tipo_usuario}}</td>
            <td>{{$dato->estado}}</td>
            <td style="text-align: center;">
                <button type="button" class="btn btn-warning" onclick="location.href='{{ route('usuario.show',$dato->id_usuario) }}'">Consultar</button>
                <button type="button" class="btn btn-primary" onclick="location.href='{{ route('usuario.edit',$dato->id_usuario) }}'">Editar</button>
                {!!Form::open(['route'=>['usuario.destroy',$dato->id_usuario], 'style'=>'display:inline' ,'method'=>'DELETE'])!!}
                    <button class="btn btn-danger">Eliminar</button>
                {!!Form::close()!!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

</div>
<br>
<br>

@endsection

@section('contentModal')

<form method="post" action="{{ route('usuario.store') }}" >
    {{ csrf_field() }}
    <div class="form-group">

        <label for="id_tipo_doc">Tipo Documento</label>
        <select class="form-control" id="id_tipo_doc" name="id_tipo_doc" required>
            <option value="">
            @foreach ($listTipoDoc as $key => $value)
                <option value="{{ $key }}"> {{ $value }} </option>
            @endforeach
        </select>

        <label for="documento">Documento</label>
        <input type="text" class="form-control" id="documento" name="documento" required>
        
        <label for="nombre">Nombres y Apellidos</label>
        <input type="text" class="form-control" id="nombre" name="nombre" required>

        <label for="correo">Correo</label>
        <input type="text" class="form-control" id="correo" name="correo" required>

        <label for="telefono">Telefono</label>
        <input type="text" class="form-control" id="telefono" name="telefono" required>

        <label for="id_estado">Estado</label>
        <select class="form-control" id="id_estado" name="id_estado" required>
            <option value="">
            @foreach ($listEstado as $key => $value)
                <option value="{{ $key }}"> {{ $value }} </option>
            @endforeach
        </select>

        <label for="id_tipo_usuario">Tipo Usuario</label>
        <select class="form-control" id="id_tipo_usuario" name="id_tipo_usuario" required>
            <option value="">
            @foreach ($listTipoUser as $key => $value)
                <option value="{{ $key }}"> {{ $value }} </option>
            @endforeach
        </select>

    </div>
    <button type="submit" class="btn btn-success">Guardar</button>
</form>

@endsection

@push('scripts')
<script>
    $(document).ready( function () {
        $('#table-listado').DataTable({
            "lengthMenu": [[5, 10, 15, -1], [5, 10, 15, "Todos"]]
        });
    });
</script>
@endpush
