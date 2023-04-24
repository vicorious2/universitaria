@extends('layouts.master')

@section('title', 'Categoria / Editar ')

@section('content')

<br>

<div style="width: 85%">

    {!!Form::open(['route'=>['categoria.update',$registro->id_categoria], 'method'=>'PUT'])!!}
        {{ csrf_field() }}
        {{ method_field('PATCH') }}
        <div class="form-group" style="width: 50%">
            <label for="nombre">Categoria</label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $registro->nombre }}" required>
        <br>
        <div style="text-align: right">
            <button type="button" class="btn btn-secondary" onclick="location.href='{{ route('categoria.index') }}'">Cancelar</button>
            <button type="submit" class="btn btn-success">Editar</button>
        </div>
        </div>
    {!!Form::close()!!}

</div>
<br>
<br>

@endsection
