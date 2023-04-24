@extends('layouts.master')

@section('title', 'Tipo Documento')
@section('titleModal', 'Agregar Tipo Documento')

@section('content')
<br>
    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addModal">Agregar</button>
<br>
<br>

<div style="width: 75%">
<table class="table table-hover table-bordered" id="table-listado" data-page-length='5'>
    <thead>
      <tr>
        <th scope="col">Id</th>
        <th scope="col">Tipo</th>
        <th scope="col">Nombre</th>
        <th scope="col">Acciones</th>
      </tr>
    </thead>
    <tbody>
    @foreach ($datosResult as $dato)
        <tr>
            <th scope="row">{{$dato->id_tipo_doc}}</th>
            <td>{{$dato->tipo_doc}}</td>
            <td>{{$dato->nombre}}</td>
            <td style="text-align: center;">
                <button type="button" class="btn btn-warning" onclick="location.href='{{ route('tipoDoc.show',$dato->id_tipo_doc) }}'">Consultar</button>
                <button type="button" class="btn btn-primary" onclick="location.href='{{ route('tipoDoc.edit',$dato->id_tipo_doc) }}'">Editar</button>
                {!!Form::open(['route'=>['tipoDoc.destroy',$dato->id_tipo_doc], 'style'=>'display:inline' ,'method'=>'DELETE'])!!}
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

<form method="post" action="{{ route('tipoDoc.store') }}" >
    {{ csrf_field() }}
    <div class="form-group">
        <label for="nombre">Tipo</label>
        <input type="text" class="form-control" id="tipo_doc" name="tipo_doc" maxlength="2" required>
        <label for="nombre">Nombre</label>
        <input type="text" class="form-control" id="nombre" name="nombre" required>
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
