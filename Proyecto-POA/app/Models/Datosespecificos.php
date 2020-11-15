<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Datosespecificos extends Model
{
    use HasFactory;
    // Se especifica la tabla a la que pertenece este modelo
    protected $table = 'dato_especificos';
    // Se especifica los datos a que pertenecen a la tabla
    protected $fillable = ['datobasicos_id', 'denoindicador', 'formindicador', 'fechacumpli',
                            'nivelactual', 'metaalcanzar', 'primeroavance', 'segundoavance', 
                            'terceroavance', 'estrategia'];
    // Se define la relacion "pertenece" con el modelo Datosbasicos
    public function Datobasicos()
    {
        return $this->belongsTo('App\Models\Datosbasicos');
    }
    // Se define la relacion "tiene uno" con el modelo Calendseguimtos
    public function Calendseguimtos()
    {
        return $this->hasOne('App\Models\Calendseguimtos');
    }
}
