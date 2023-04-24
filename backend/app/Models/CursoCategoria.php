<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CursoCategoria extends Model
{
    use HasFactory;
    
    protected $table = 'curso_categoria';
    protected $primaryKey = 'id_curso_categoria';
    public $timestamps = false;
}
