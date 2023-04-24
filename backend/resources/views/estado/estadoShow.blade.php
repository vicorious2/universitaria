@extends('layouts.master')

@section('title', 'Estado / Consultar ')

@section('content')

<br>

<div style="width: 85%">

    <form>
        <fieldset disabled>
        <div class="form-group" style="width: 50%">
            <label for="nombre">Estado</label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $registro->nombre }}">
        <br>
        </div>
        </fieldset>
        <button type="button" class="btn btn-primary" onclick="location.href='{{ route('estado.edit',$registro->id_estado) }}'">Editar</button>
    </form>

</div>
<br>
<br>

@endsection
