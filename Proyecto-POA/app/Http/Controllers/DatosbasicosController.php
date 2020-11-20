<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Datosbasicos;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class DatosbasicosController extends Controller
{
    // Función que muestra el contenido del data table
    public function index(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        if(Auth::user()->rol == 'Administrador'){
            $datobasicos = Datosbasicos::select('dato_basicos.id', 'dato_basicos.denoproceso', 'dato_basicos.numproceso', 
                                'dato_basicos.mejoraproceso', 'dato_basicos.arearesponsable', 'dato_basicos.objetivoproceso',
                                'dato_basicos.pideatencion', 'dato_basicos.problematica')
                                ->orderBy('dato_basicos.id', 'asc')->paginate(1);
        }
        if(Auth::user()->rol == 'Trabajador'){
            $datobasicos = Datosbasicos::select('dato_basicos.id', 'dato_basicos.denoproceso', 'dato_basicos.numproceso', 
                                'dato_basicos.mejoraproceso', 'dato_basicos.arearesponsable', 'dato_basicos.objetivoproceso',
                                'dato_basicos.pideatencion', 'dato_basicos.problematica')
                                ->where('user_id', Auth::user()->id)
                                ->orderBy('dato_basicos.id', 'asc')->paginate(1);
        }
        
        return [
            'pagination' => [
                'total'        => $datobasicos->total(),
                'current_page' => $datobasicos->currentPage(),
                'per_page'     => $datobasicos->perPage(),
                'last_page'    => $datobasicos->lastPage(),
                'from'         => $datobasicos->firstItem(),
                'to'           => $datobasicos->lastItem(),
            ],
            'dato_basicos' => $datobasicos
        ];
    }

    // Función que contiene la lógica para almacenar un registro
    public function store(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        $datobasico = new Datosbasicos();
        $datobasico->denoproceso = $request->denoproceso;
        $datobasico->numproceso = $request->numproceso;
        $datobasico->mejoraproceso = $request->mejoraproceso;
        $datobasico->arearesponsable = $request->arearesponsable;
        $datobasico->objetivoproceso = $request->objetivoproceso;
        $datobasico->pideatencion = $request->pideatencion;
        $datobasico->problematica = $request->problematica;
        $datobasico->user_id = Auth::user()->id;
        $datobasico->save();
    }

    // Función que contiene la lógica para actualizar un registro
    public function update(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        $datobasico = Datosbasicos::findOrFail($request->id);
        $datobasico->denoproceso = $request->denoproceso;
        $datobasico->numproceso = $request->numproceso;
        $datobasico->mejoraproceso = $request->mejoraproceso;
        $datobasico->arearesponsable = $request->arearesponsable;
        $datobasico->objetivoproceso = $request->objetivoproceso;
        $datobasico->pideatencion = $request->pideatencion;
        $datobasico->problematica = $request->problematica;
        $datobasico->save();
    }

    // Función que contiene la lógica para eliminar un registro
    public function destroy(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        $datobasico = Datosbasicos::findOrFail($request->id);
        $datobasico->delete();
    }
}
