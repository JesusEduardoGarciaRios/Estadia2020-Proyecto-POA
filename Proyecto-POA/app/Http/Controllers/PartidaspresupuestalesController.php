<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Partidaspresupuestales;

class PartidaspresupuestalesController extends Controller
{
    // Función que muestra el contenido del data table
    public function index(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        $partidaspresupuestales = Partidaspresupuestales::select('partida_presupuestales.id', 'partida_presupuestales.partidapresu')
                            ->orderBy('partida_presupuestales.id', 'desc')->paginate(3);
        
        return [
            'pagination' => [
                'total'        => $partidaspresupuestales->total(),
                'current_page' => $partidaspresupuestales->currentPage(),
                'per_page'     => $partidaspresupuestales->perPage(),
                'last_page'    => $partidaspresupuestales->lastPage(),
                'from'         => $partidaspresupuestales->firstItem(),
                'to'           => $partidaspresupuestales->lastItem(),
            ],
            'partida_presupuestales' => $partidaspresupuestales
        ];
    }

    // Función que contiene la lógica para almacenar un registro
    public function store(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        $partidaspresupuestal = new Partidaspresupuestales();
        $partidaspresupuestal->partidapresu = $request->partidapresu;
        $partidaspresupuestal->save();
    }

    // Función que contiene la lógica para actualizar un registro
    public function update(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        $partidaspresupuestal = Partidaspresupuestales::findOrFail($request->id);
        $partidaspresupuestal->partidapresu = $request->partidapresu;
        $partidaspresupuestal->save();
    }

    // Función que contiene la lógica para eliminar un registro
    public function destroy(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        $partidaspresupuestal = Partidaspresupuestales::findOrFail($request->id);
        $partidaspresupuestal->delete();
    }
}