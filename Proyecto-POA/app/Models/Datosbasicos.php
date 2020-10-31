<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Datosbasicos extends Model
{
    use HasFactory;
    // Se especifica la tabla a la que pertenece este modelo
    protected $table = 'dato_basicos';
    // Se especifica los datos a que pertenecen a la tabla
    protected $fillable = ['denoproceso', 'numproceso',	'mejoraproceso', 'arearesponsable',
    	                    'objetivoproceso', 'pideatencion', 'problematica'];
}
