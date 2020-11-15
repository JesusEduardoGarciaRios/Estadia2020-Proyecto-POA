<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partidaspresupuestales extends Model
{
    use HasFactory;
    // Se especifica la tabla a la que pertenece este modelo
    protected $table = 'partida_presupuestales';
    // Se especifica los datos a que pertenecen a la tabla
    protected $fillable = ['partidapresu'];
    // Se define la relacion "tiene varios" con el modelo Recursosrequeridos
    public function Recursosrequeridos()
    {
        return $this->hasMany('App\Models\Recursosrequeridos');
    }
}
