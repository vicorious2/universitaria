@extends('layouts.master')

@section('title', 'Gestion Clases / Editar ')

@section('content')

<br>

<div style="width: 85%">

    {!!Form::open(['route'=>['clase.update',$registro->id_clase], 'method'=>'PUT'])!!}
        {{ csrf_field() }}
        {{ method_field('PATCH') }}
        <div class="form-group" style="width: 50%">

        <label for="id_curso">Curso</label>
        <select class="form-control" id="id_curso" name="id_curso" required>
            <option value="">
            @foreach ($listCurso as $key => $value)
                <option value="{{ $key }}" {{$registro->id_curso == $key  ? 'selected' : ''}}> {{ $value }} </option>
            @endforeach
        </select>

        <label for="nombre">Clase</label>
        <input type="text" class="form-control" id="nombre" name="nombre" value="{{$registro->nombre}}" required>

        <label for="descripcion">Descripcion</label>
        <input type="text" class="form-control" id="descripcion" name="descripcion" value="{{$registro->descripcion}}" required>
        
        <br>

        <label for="recursos">Recursos</label>
        @if ($registro->list != "")
        <ul>
        @foreach(explode('|', $registro->list) as $item) 
            <li class="list-group-item disabled" aria-disabled="true">{{ $item }}</li>
        @endforeach
        </ul>
        @endif
        
        <br>
        <div style="text-align: right">
            <button type="button" class="btn btn-secondary" onclick="location.href='{{ route('clase.index') }}'">Cancelar</button>
            <button type="submit" class="btn btn-success">Editar</button>
        </div>
        </div>
    {!!Form::close()!!}

</div>
<br>
<br>

@endsection
