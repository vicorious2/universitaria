@extends('layouts.master')

@section('title', 'Gestion Clases / Consultar ')

@section('content')

<br>

<div style="width: 85%">

    <form>
        <fieldset disabled>
        <div class="form-group" style="width: 80%">
            
        <label for="curso">Curso</label>
        <input type="text" class="form-control" id="curso" name="curso" value="{{$registro->curso}}">

        <label for="nombre">Clase</label>
        <input type="text" class="form-control" id="nombre" name="nombre" value="{{$registro->nombre}}">

        <label for="descripcion">Descripcion</label>
        <input type="text" class="form-control" id="descripcion" name="descripcion" value="{{$registro->descripcion}}">
        
        <label for="recursos">Recursos</label>
        @if ($registro->list != "")
        <ul>
        @foreach(explode('|', $registro->list) as $item) 
            <li class="list-group-item disabled" aria-disabled="true">{{ $item }}</li>
        @endforeach
        </ul>
        @endif

        <br>
        </div>
        </fieldset>
        <button type="button" class="btn btn-primary" onclick="location.href='{{ route('clase.edit',$registro->id_clase) }}'">Editar</button>
    </form>

</div>
<br>
<br>

@endsection
