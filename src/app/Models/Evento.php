<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    // Especifica el nombre de la tabla en la base de datos
    protected $table = 'eventos';

    // Define los campos que pueden ser asignados de forma masiva (rellenables)
    protected $fillable = [
        'titulo',
        'descripcion',
        'fecha_inicio',
        'fecha_fin',
        'ubicacion'
    ];
}
