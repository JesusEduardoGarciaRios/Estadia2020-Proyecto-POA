<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Calendseguimtos;
use App\Models\Recursosrequeridos;
use App\Models\Partidaspresupuestales;
use App\Models\User;

class RecursosrequeridosController extends Controller
{
    // Función que muestra el contenido del data table
    public function index(Request $request)
    {
    if(!$request->ajax()) return redirect('/');
        $recursorequeridos = Recursosrequeridos::join('calend_seguimtos', 'recurso_requeridos.calendseguimtos_id', '=', 'calend_seguimtos.id')
                            ->join('partida_presupuestales', 'recurso_requeridos.partidapresu_id', '=', 'partida_presupuestales.id')
                            ->select('recurso_requeridos.id', 'recurso_requeridos.calendseguimtos_id', 'recurso_requeridos.concepto', 
                            'recurso_requeridos.partidapresu_id', 'recurso_requeridos.unidadmedida', 'recurso_requeridos.cantidad', 
                            'recurso_requeridos.costoaprox', 'calend_seguimtos.actividad as nombre_actividad', 'partida_presupuestales.partidapresu as nombre_partidapresu')
                            // ->where('users.rol', 'Trabajador')
                            ->orderBy('recurso_requeridos.id', 'desc')->paginate(1);
        
        return [
            'pagination' => [
                'total'        => $recursorequeridos->total(),
                'current_page' => $recursorequeridos->currentPage(),
                'per_page'     => $recursorequeridos->perPage(),
                'last_page'    => $recursorequeridos->lastPage(),
                'from'         => $recursorequeridos->firstItem(),
                'to'           => $recursorequeridos->lastItem(),
            ],
            'recurso_requeridos' => $recursorequeridos
        ];
    }

    // Función que contiene la lógica para almacenar un registro
    public function store(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        $recursorequerido = new Recursosrequeridos();
        $recursorequerido->calendseguimtos_id = $request->calendseguimtos_id;
        $recursorequerido->concepto = $request->concepto;
        $recursorequerido->partidapresu_id = $request->partidapresu_id;
        $recursorequerido->unidadmedida = $request->unidadmedida;
        $recursorequerido->cantidad = $request->cantidad;
        $recursorequerido->costoaprox = $request->costoaprox;
        $recursorequerido->save();
    }

    // Función que contiene la lógica para actualizar un registro
    public function update(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        $recursorequerido = Recursosrequeridos::findOrFail($request->id);
        $recursorequerido->calendseguimtos_id = $request->calendseguimtos_id;
        $recursorequerido->concepto = $request->concepto;
        $recursorequerido->partidapresu_id = $request->partidapresu_id;
        $recursorequerido->unidadmedida = $request->unidadmedida;
        $recursorequerido->cantidad = $request->cantidad;
        $recursorequerido->costoaprox = $request->costoaprox;
        $recursorequerido->save();
    }

    // Función que contiene la lógica para eliminar un registro
    public function destroy(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        $recursorequerido = Recursosrequeridos::findOrFail($request->id);
        $recursorequerido->delete();
    }

    // Función que contiene la lógica para llenar el campo select recursos requeridos
    public function selectActividad(Request $request){
        if(!$request->ajax()) return redirect('/');
        $calendseguimto = Calendseguimtos::select('id','actividad')
                            ->from('calend_seguimtos')->get();
        return ['calend_seguimtos' => $calendseguimto];
    }

    // Función que contiene la lógica para llenar el segundo campo select recursos requeridos
    public function selectPartidapresupuestal(Request $request){
        if(!$request->ajax()) return redirect('/');
        $partidapresupuestal = Partidaspresupuestales::select('id','partidapresu')
                            ->from('partida_presupuestales')->get();
        return ['partida_presupuestales' => $partidapresupuestal];
    }
}
