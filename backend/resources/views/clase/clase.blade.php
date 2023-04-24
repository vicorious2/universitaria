@extends('layouts.master')

@section('title', 'Gestion Clases')
@section('titleModal', 'Agregar Clase')
@section('titleModalInfo', 'Listado Recursos')

@section('content')
<br>
    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addModal">Agregar</button>
<br>
<br>

<div style="width: 100%">
<table class="table table-hover table-bordered" id="table-listado" data-page-length='5'>
    <thead>
      <tr>
        <!-- <th scope="col">Id</th> -->
        <th scope="col">Curso</th>
        <th scope="col">Clase</th>
        <th scope="col">Descripcion</th>
        <th scope="col">Orden</th>
        <th scope="col">Recursos</th>
        <th scope="col">Acciones</th>
      </tr>
    </thead>
    <tbody>
    @foreach ($datosResult as $dato)
        <tr>
            <!-- <th scope="row">{{$dato->id_clase}}</th> -->
            <td>{{$dato->curso}}</td>
            <td>{{$dato->nombre}}</td>
            <td>{{$dato->descripcion}}</td>
            <td>{{$dato->orden}}</td>
            <td style="text-align: center;">
            <button type="button" class="btn btn-info" data-url="{{ route('getResourceForIdClass', $dato->id_clase) }}" id="show-resource">
                Recursos <span class="badge badge-light">{{$dato->cant}}</span>
            </button>
            </td>
            <td style="text-align: center;">
                <button type="button" class="btn btn-warning" onclick="location.href='{{ route('clase.show',$dato->id_clase) }}'">Consultar</button>
                <button type="button" class="btn btn-primary" onclick="location.href='{{ route('clase.edit',$dato->id_clase) }}'">Editar</button>
                {!!Form::open(['route'=>['clase.destroy',$dato->id_clase], 'style'=>'display:inline' ,'method'=>'DELETE'])!!}
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

<form method="post" action="{{ route('clase.store') }}" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="form-group" id="inputClassAdd">

        <label for="id_curso">Curso</label>
        <select class="form-control" id="id_curso" name="id_curso" required>
            <option value="">
            @foreach ($listCurso as $key => $value)
                <option value="{{ $key }}"> {{ $value }} </option>
            @endforeach
        </select>

        <label for="nombre">Nombre</label>
        <input type="text" class="form-control" id="nombre" name="nombre" required>

        <label for="descripcion">Descripcion</label>
        <input type="text" class="form-control" id="descripcion" name="descripcion" required>
        
        <br>

        <label for="videoClase">Video</label>
        <div class="custom-file">
            <input type="file" name="videoClase" class="custom-file-input" id="videoClase" accept="video/*" required>
            <label class="custom-file-label" for="videoClase" data-browse="Seleccionar">Video</label>
        </div>

        <!-- <label for="miniaturaClase">Miniatura Video</label>
        <div class="custom-file">
            <input type="file" name="miniaturaClase" class="custom-file-input" id="miniaturaClase" accept="image/png, image/jpeg">
            <label class="custom-file-label" for="miniaturaClase" data-browse="Seleccionar">Imagen</label>
        </div> -->

        <label for="documentClase">Documento</label>
        <div class="custom-file">
            <input type="file" name="documentClase" class="custom-file-input" id="documentClase" accept=".xlsx,.xls,.doc,.docx,.txt,.pdf">
            <label class="custom-file-label" for="documentClase" data-browse="Seleccionar">Documento</label>
        </div>

    </div>
    <button type="submit" id="guardarClase" class="btn btn-success">Guardar</button>

    <button class="btn btn-primary" type="button" id="cargarClase" disabled>
        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
        Cargando Archivos...
    </button>

</form>

@endsection

@section('contentModalInfo')
<div class="form-group">
    <label for="">Recursos</label>
    <br>
    <table class="table table-bordered" id="listResource">
    <thead>
        <tr>
            <th scope="col">Tipo</th>
            <th scope="col">Recurso</th>
            <!-- <th scope="col">Descargar</th> -->
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>

</div>
@endsection

@push('scripts')
<script>
    $(document).ready( function () {
        $('#table-listado').DataTable({
            "lengthMenu": [[5, 10, 15, -1], [5, 10, 15, "Todos"]]
        });
        bsCustomFileInput.init();
        $("#cargarClase").hide();

        $('#guardarClase').on('click', function() {
            $("#guardarClase").hide();
            $("#inputClassAdd").hide();
            $("#cargarClase").show();
        });

        $('body').on('click', '#show-resource', function () {
            var userURL = $(this).data('url');
 
            $.get(userURL, function (data) {
                
                $('#infoModal').modal('show');
                $('#listResource tbody').empty();

                for(var i=0; i<data['listResource'].length; i++){
                   
                    let trElement = document.createElement('tr');

                    const tdItemType = document.createElement('td');
                    tdItemType.appendChild(document.createTextNode(data['listResource'][i].tipo));
                    trElement.appendChild(tdItemType);

                    const tdItemName = document.createElement('td');
                    tdItemName.appendChild(document.createTextNode(data['listResource'][i].recurso));
                    trElement.appendChild(tdItemName);

                    /* Funcion solo disponible en local storage */
                    // const tdItemRoute = document.createElement('td');
                    // tdItemRoute.appendChild(document.createTextNode(data['listResource'][i].ruta));
                    // trElement.appendChild(tdItemRoute);

                    // const tdItemDownload = document.createElement('td');
                    // const buttonItem = document.createElement('button');
                    // buttonItem.classList.add('btn', 'btn-success');
                    // buttonItem.innerHTML = "Descargar";
                    // let ruta = "location.href='"+ window.location.origin+"/getResourceDownload/"+data['listResource'][i].id_recurso+"'";
                    // buttonItem.setAttribute("onclick", ruta);

                    // tdItemDownload.appendChild(buttonItem);
                    // trElement.appendChild(tdItemDownload);

                    $("#listResource tbody").append(trElement);

                }
            })
        });

    });
</script>
@endpush
