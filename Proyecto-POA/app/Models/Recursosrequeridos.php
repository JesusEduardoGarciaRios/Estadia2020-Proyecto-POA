<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recursosrequeridos extends Model
{
    use HasFactory;
    // Se especifica la tabla a la que pertenece este modelo
    protected $table = 'recurso_requeridos';
    // Se especifica los datos a que pertenecen a la tabla
    protected $fillable = ['calendseguimtos_id', 'concepto', 'partidapresu_id', 'unidadmedida',
                            'cantidad', 'costoaprox'];
    // Se define la relacion "pertenece" con el modelo Calendseguimtos
    public function Calendseguimtos()
    {
        return $this->belongsTo('App\Models\Calendseguimtos');
    }
    // Se define la relacion "pertenece" con el modelo Partidapresupuestales
    public function Partidapresupuestales()
    {
        return $this->belongsTo('App\Models\Partidapresupuestales');
    }
}
