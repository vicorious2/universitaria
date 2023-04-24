@extends('layouts.master')

@section('title', 'Gestion Cursos / Editar ')

@section('content')

<br>

<div style="width: 85%">

    {!!Form::open(['route'=>['curso.update',$registro->id_curso], 'method'=>'PUT'])!!}
        {{ csrf_field() }}
        {{ method_field('PATCH') }}
        <div class="form-group" style="width: 50%">

        <label for="nombre">Nombre</label>
        <input type="text" class="form-control" id="nombre" name="nombre"  value="{{$registro->nombre}}">

        <label for="descripcion">Descripcion</label>
        <input type="text" class="form-control" id="descripcion" name="descripcion"  value="{{$registro->descripcion}}">

        <label for="id_usuario_p">Profesor</label>
        <select class="form-control" id="id_usuario_p" name="id_usuario_p" required>
        <option value="">
            @foreach ($listUser as $key => $value)
                <option value="{{ $key }}" {{$registro->id_usuario_p == $key  ? 'selected' : ''}}> {{ $value }} </option>
            @endforeach
        </select>

        <label for="id_facultad">Facultad</label>
        <select class="form-control" id="id_facultad" name="id_facultad" required>
            <option value="">
            @foreach ($listFacultad as $key => $value)
                <option value="{{ $key }}" {{$registro->id_facultad == $key  ? 'selected' : ''}}> {{ $value }} </option>
            @endforeach
        </select>
        
        <label for="id_nivel">Nivel</label>
        <select class="form-control" id="id_nivel" name="id_nivel" required>
            <option value="">
            @foreach ($listNivel as $key => $value)
                <option value="{{ $key }}" {{$registro->id_nivel == $key  ? 'selected' : ''}}> {{ $value }} </option>
            @endforeach
        </select>

        <label for="id_categoria">Categoria</label>
        <input type="hidden" id="id_categoria_ant" name="id_categoria_ant" value="{{$registro->categorias}}">
        <input type="hidden" id="id_categoria" name="id_categoria" value="{{$registro->categorias}}">
        <select class="form-control selectpickerUpdate" multiple data-live-search="true" required>
            @foreach ($listCategoria as $key => $value)
                <option value="{{ $key }}"> {{ $value }} </option>
            @endforeach
        </select>

        <label for="id_estado">Estado</label>
        <select class="form-control" id="id_estado" name="id_estado" required>
            <option value="">
            @foreach ($listEstado as $key => $value)
                <option value="{{ $key }}" {{$registro->id_estado == $key  ? 'selected' : ''}}> {{ $value }} </option>
            @endforeach
        </select>
        
        <br>
        <div style="text-align: right">
            <button type="button" class="btn btn-secondary" onclick="location.href='{{ route('curso.index') }}'">Cancelar</button>
            <button type="submit" class="btn btn-success">Editar</button>
        </div>
        </div>
    {!!Form::close()!!}

</div>
<br>
<br>

@endsection

@push('scripts')
<script>
    $(document).ready( function () {
        $('.selectpickerUpdate').selectpicker();
        $('.selectpickerUpdate').selectpicker('setStyle', 'btn-light', 'remove');
        $('.selectpickerUpdate').selectpicker('setStyle', 'btn', 'remove');
        $('.selectpickerUpdate').selectpicker('setStyle', 'form-control', 'add');

        var cat = $('#id_categoria_ant').val();
        var categorias = cat.split(",");
        
        $('.selectpickerUpdate').selectpicker('val', categorias );
        $('.selectpickerUpdate').selectpicker('render');

        $('.selectpickerUpdate').change(function () {
            var selectedItemUpd = $('.selectpickerUpdate').val();
            $('#id_categoria').val(selectedItemUpd);
        });
    });
</script>
@endpush