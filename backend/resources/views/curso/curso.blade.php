@extends('layouts.master')

@section('title', 'Gestion Cursos')
@section('titleModal', 'Agregar Curso')
@section('titleModalInfo', 'Listado de Clases')

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
        <th scope="col">Nombre</th>
        <th scope="col">Profesor</th>
        <th scope="col">Facultad</th>
        <th scope="col">Nivel</th>
        <th scope="col">Categorias</th>
        <th scope="col">Estado</th>
        <th scope="col">Descripcion</th>
        <th scope="col">Clases</th>
        <th scope="col">Acciones</th>
      </tr>
    </thead>
    <tbody>
    @foreach ($datosResult as $dato)
        <tr>
            <th scope="row">{{$dato->id_curso}}</th>
            <td>{{$dato->nombre}}</td>
            <td>{{$dato->profesor}}</td>
            <td>{{$dato->facultad}}</td>
            <td>{{$dato->nivel}}</td>
            <td>
            @if ($dato->categorias != "")
                @foreach(explode('|', $dato->categorias) as $categoria) 
                <span class="badge badge-pill badge-info">{{$categoria}}</span>
                @endforeach
            @endif
            </td>
            <td>{{$dato->estado}}</td>
            <td>{{$dato->descripcion}}</td>
            <td style="text-align: center;">
            <button type="button" class="btn btn-info show-clases" data-url="{{ route('getAllClassByCourse', $dato->id_curso) }}" 
                data-curso="{{$dato->nombre}}" data-idcurso="{{$dato->id_curso}}" id="show-clases{{$dato->id_curso}}">
                Ordenar Clases <span class="badge badge-light">{{$dato->clases}}</span>
            </button>
            </td>
            <td style="text-align: center;">
                <button type="button" class="btn btn-warning" onclick="location.href='{{ route('curso.show',$dato->id_curso) }}'">Consultar</button>
                <button type="button" class="btn btn-primary" onclick="location.href='{{ route('curso.edit',$dato->id_curso) }}'">Editar</button>
                {!!Form::open(['route'=>['curso.destroy',$dato->id_curso], 'style'=>'display:inline' ,'method'=>'DELETE'])!!}
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

<form method="post" action="{{ route('curso.store') }}" >
    {{ csrf_field() }}
    <div class="form-group">

        <label for="nombre">Nombre</label>
        <input type="text" class="form-control" id="nombre" name="nombre" required>

        <label for="descripcion">Descripcion</label>
        <input type="text" class="form-control" id="descripcion" name="descripcion" required>

        <label for="id_usuario_p">Profesor</label>
        <select class="form-control" id="id_usuario_p" name="id_usuario_p" required>
            <option value="">
            @foreach ($listUser as $key => $value)
                <option value="{{ $key }}"> {{ $value }} </option>
            @endforeach
        </select>
        
        <label for="id_facultad">Facultad</label>
        <select class="form-control" id="id_facultad" name="id_facultad" required>
            <option value="">
            @foreach ($listFacultad as $key => $value)
                <option value="{{ $key }}"> {{ $value }} </option>
            @endforeach
        </select>

        <label for="id_nivel">Nivel</label>
        <select class="form-control" id="id_nivel" name="id_nivel" required>
            <option value="">
            @foreach ($listNivel as $key => $value)
                <option value="{{ $key }}"> {{ $value }} </option>
            @endforeach
        </select>

        <label for="id_categoria">Categoria</label>
        <input type="hidden" id="id_categoria" name="id_categoria" >
        <select class="form-control selectpicker" multiple data-live-search="true" title="Seleccionar Categorias" required>
            @foreach ($listCategoria as $key => $value)
                <option value="{{ $key }}"> {{ $value }} </option>
            @endforeach
        </select>

        <label for="id_estado">Estado</label>
        <select class="form-control" id="id_estado" name="id_estado" required>
            <option value="">
            @foreach ($listEstado as $key => $value)
                <option value="{{ $key }}"> {{ $value }} </option>
            @endforeach
        </select>

    </div>
    <button type="submit" class="btn btn-success">Guardar</button>
</form>

@endsection

@section('contentModalInfo')
<div class="form-group">
    <label for="" id="labelNameCourse"></label>
    <input type="hidden" id="inputIdCurso">
    <div class="alert alert-danger hidden" id="errorSelected" role="alert">
        El orden seleccionado es el mismo, elija otro.
    </div>
    <div class="alert alert-success hidden" id="okChangeOrder" role="alert">
        Orden Actualizado.
    </div>
    <table class="table table-bordered" id="listClass" style="text-align: center;">
        <thead>
            <tr>
                <th scope="col">Clase</th>
                <th scope="col">Orden Actual</th>
                <th scope="col">Cambiar Orden</th>
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

        $('.selectpicker').selectpicker();
        $('.selectpicker').selectpicker('setStyle', 'btn-light', 'remove');
        $('.selectpicker').selectpicker('setStyle', 'btn', 'remove');
        $('.selectpicker').selectpicker('setStyle', 'form-control', 'add');

        $('.selectpicker').change(function () {
            var selectedItem = $('.selectpicker').val();
            $('#id_categoria').val(selectedItem);
        });       

        $("#addModal").on("hidden.bs.modal", function () {
            $('.selectpicker').selectpicker('deselectAll');
        });

        $("#errorSelected").hide();
        $("#okChangeOrder").hide();

        $('body').on('click', '.show-clases', function () {
            $("#errorSelected").hide();
            var classURL = $(this).data('url');
            var nameCourse = $(this).data('curso');
            var idCourse = $(this).data('idcurso');
            $.get(classURL, function (data) {
                
                $('#labelNameCourse').text('Clases del Curso: '+nameCourse);
                $('#inputIdCurso').val(idCourse);
                $('#infoModal').modal('show');
                $('#listClass tbody').empty();

                for(var i=0; i<data['listClass'].length; i++){
                    
                    let trElement = document.createElement('tr');

                    const tdItemName = document.createElement('td');
                    tdItemName.appendChild(document.createTextNode(data['listClass'][i].nombre));
                    trElement.appendChild(tdItemName);

                    const tdItemOrder = document.createElement('td');
                    const inputOrder = document.createElement('input');
                    inputOrder.setAttribute('id', 'input'+data['listClass'][i].id_clase);
                    inputOrder.setAttribute('value', data['listClass'][i].orden);
                    inputOrder.setAttribute('hidden', '');
                    tdItemOrder.appendChild(document.createTextNode(data['listClass'][i].orden));
                    tdItemOrder.appendChild(inputOrder);
                    trElement.appendChild(tdItemOrder);

                    
                    const tdItemSelect = document.createElement('td');
                    tdItemSelect.classList.add('form-inline');
                    const selectItem = document.createElement('select');
                    selectItem.setAttribute('id', 'select'+data['listClass'][i].id_clase);
                    selectItem.classList.add('form-control','form-control-sm','w-50','mr-2');

                    // Listado de opciones de orden
                    for (var j = 0; j < data['listOrders'].length; j++) {
                        var option = document.createElement("option");
                        option.value = data['listOrders'][j].orden;
                        option.text = 'Cambiar Por : '+data['listOrders'][j].orden;
                        selectItem.appendChild(option);
                    }
                    // boton cambio de orden 
                    const buttonItem = document.createElement('button');
                    buttonItem.classList.add('btn', 'btn-success','btn-sm');
                    buttonItem.innerHTML = "Cambiar";
                    buttonItem.setAttribute("onclick", "changeOrder("+data['listClass'][i].id_clase+")");

                    tdItemSelect.appendChild(selectItem);
                    tdItemSelect.appendChild(buttonItem);

                    trElement.appendChild(tdItemSelect);
                    
                    $("#listClass tbody").append(trElement);

                }
            });
        });

    });

    function changeOrder(idClass){
        $("#errorSelected").hide();
        $("#okChangeOrder").hide();
        
        const valueSelect = $("#select"+idClass).val();
        const valueInput = $("#input"+idClass).val();
        const idCurso = $("#inputIdCurso").val();

        if(valueSelect == valueInput){
            $("#errorSelected").show();
        }else{
            $.post( "/changeOrderClassByCourse",{ 
                '_token': $('meta[name=csrf-token]').attr('content'),
                id_clase: idClass,
                id_curso: idCurso,
                ordenNuevo: valueSelect,
                ordenActual: valueInput,
            })
            .done(function( data ) {
                $("#okChangeOrder").show();
                $('#show-clases'+idCurso).click();
                setTimeout(function() {
                    $("#okChangeOrder").hide();
                },3000);
            });
        }
    }
</script>
@endpush
