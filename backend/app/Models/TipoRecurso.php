<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoRecurso extends Model
{
    use HasFactory;

    protected $table = 'tipo_recurso';
    protected $primaryKey = 'id_tipo_recurso';
    public $timestamps = false;
}
