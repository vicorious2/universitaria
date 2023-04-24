@extends('layouts.master')

@section('title', 'Estado / Editar ')

@section('content')

<br>

<div style="width: 85%">

    {!!Form::open(['route'=>['estado.update',$registro->id_estado], 'method'=>'PUT'])!!}
        {{ csrf_field() }}
        {{ method_field('PATCH') }}
        <div class="form-group" style="width: 50%">
            <label for="nombre">Estado</label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $registro->nombre }}" required>
        <br>
        <div style="text-align: right">
            <button type="button" class="btn btn-secondary" onclick="location.href='{{ route('estado.index') }}'">Cancelar</button>
            <button type="submit" class="btn btn-success">Editar</button>
        </div>
        </div>
    {!!Form::close()!!}

</div>
<br>
<br>

@endsection
