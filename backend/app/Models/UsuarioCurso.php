<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsuarioCurso extends Model
{
    use HasFactory;

    protected $table = 'usuario_curso';
    protected $primaryKey = 'id_usuario_curso';
    public $timestamps = false;
}
