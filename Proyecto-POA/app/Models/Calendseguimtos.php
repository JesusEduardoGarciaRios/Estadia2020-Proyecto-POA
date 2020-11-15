<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calendseguimtos extends Model
{
    use HasFactory;
    // Se especifica la tabla a la que pertenece este modelo
    protected $table = 'calend_seguimtos';
    // Se especifica los datos a que pertenecen a la tabla
    protected $fillable = ['datoespecificos_id', 'actividad', 'unidadmedida', 'metaanual',
                            'prog1', 'alc1', 'prog2', 'alc2', 'prog3', 'alc3', 'justificacion',
                            'areaoperadora'];
    // Se define la relacion "pertenece" con el modelo Datosespecificos
    public function Datoespecificos()
    {
        return $this->belongsTo('App\Models\Datosespecificos');
    }
    // Se define la relacion "tiene uno" con el modelo Recursosrequeridos
    public function Recursosrequeridos()
    {
        return $this->hasOne('App\Models\Recursosrequeridos');
    }
}
