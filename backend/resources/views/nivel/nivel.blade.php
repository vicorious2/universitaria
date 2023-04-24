@extends('layouts.master')

@section('title', 'Nivel')
@section('titleModal', 'Agregar Nivel')

@section('content')
<br>
    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addModal">Agregar</button>
<br>
<br>

<div style="width: 50%">
<table class="table table-hover table-bordered" id="table-listado" data-page-length='5'>
    <thead>
      <tr>
        <th scope="col">Id</th>
        <th scope="col">Nivel</th>
        <th scope="col">Acciones</th>
      </tr>
    </thead>
    <tbody>
    @foreach ($datosResult as $dato)
        <tr>
            <th scope="row">{{$dato->id_nivel}}</th>
            <td>{{$dato->nombre}}</td>
            <td style="text-align: center;">
                <button type="button" class="btn btn-warning" onclick="location.href='{{ route('nivel.show',$dato->id_nivel) }}'">Consultar</button>
                <button type="button" class="btn btn-primary" onclick="location.href='{{ route('nivel.edit',$dato->id_nivel) }}'">Editar</button>
                {!!Form::open(['route'=>['nivel.destroy',$dato->id_nivel], 'style'=>'display:inline' ,'method'=>'DELETE'])!!}
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

<form method="post" action="{{ route('nivel.store') }}" >
    {{ csrf_field() }}
    <div class="form-group">
        <label for="nombre">Nivel</label>
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
