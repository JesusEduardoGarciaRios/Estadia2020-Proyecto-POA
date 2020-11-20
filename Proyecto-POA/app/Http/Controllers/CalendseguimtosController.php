<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Datosespecificos;
use App\Models\Calendseguimtos;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class CalendseguimtosController extends Controller
{
    // Función que muestra el contenido del data table
    public function index(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        if(Auth::user()->rol == 'Administrador'){
            $calendseguimtos = Calendseguimtos::join('dato_especificos', 'calend_seguimtos.datoespecificos_id', '=', 'dato_especificos.id')
                            ->select('calend_seguimtos.id', 'calend_seguimtos.datoespecificos_id', 'calend_seguimtos.actividad', 
                            'calend_seguimtos.unidadmedida', 'calend_seguimtos.metaanual', 'calend_seguimtos.prog1', 
                            'calend_seguimtos.alc1', 'calend_seguimtos.prog2', 'calend_seguimtos.alc2', 
                            'calend_seguimtos.prog3', 'calend_seguimtos.alc3', 'calend_seguimtos.justificacion', 'calend_seguimtos.areaoperadora', 
                            'dato_especificos.denoindicador as nombre_denoindicador')
                            ->orderBy('calend_seguimtos.id', 'asc')->paginate(4);
        }
        if(Auth::user()->rol == 'Trabajador'){
            $calendseguimtos = Calendseguimtos::join('dato_especificos', 'calend_seguimtos.datoespecificos_id', '=', 'dato_especificos.id')
                            ->select('calend_seguimtos.id', 'calend_seguimtos.datoespecificos_id', 'calend_seguimtos.actividad', 
                            'calend_seguimtos.unidadmedida', 'calend_seguimtos.metaanual', 'calend_seguimtos.prog1', 
                            'calend_seguimtos.alc1', 'calend_seguimtos.prog2', 'calend_seguimtos.alc2', 
                            'calend_seguimtos.prog3', 'calend_seguimtos.alc3', 'calend_seguimtos.justificacion', 'calend_seguimtos.areaoperadora', 
                            'dato_especificos.denoindicador as nombre_denoindicador')
                            ->where('calend_seguimtos.user_id', Auth::user()->id)
                            ->orderBy('calend_seguimtos.id', 'asc')->paginate(4);
        }
        
        return [
            'pagination' => [
                'total'        => $calendseguimtos->total(),
                'current_page' => $calendseguimtos->currentPage(),
                'per_page'     => $calendseguimtos->perPage(),
                'last_page'    => $calendseguimtos->lastPage(),
                'from'         => $calendseguimtos->firstItem(),
                'to'           => $calendseguimtos->lastItem(),
            ],
            'calend_seguimtos' => $calendseguimtos
        ];
    }

    // Función que contiene la lógica para almacenar un registro
    public function store(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        $calendseguimto = new Calendseguimtos();
        $calendseguimto->datoespecificos_id = $request->datoespecificos_id;
        $calendseguimto->actividad = $request->actividad;
        $calendseguimto->unidadmedida = $request->unidadmedida;
        $calendseguimto->metaanual = $request->metaanual;
        $calendseguimto->prog1 = $request->prog1;
        $calendseguimto->alc1 = $request->alc1;
        $calendseguimto->prog2 = $request->prog2;
        $calendseguimto->alc2 = $request->alc2;
        $calendseguimto->prog3 = $request->prog3;
        $calendseguimto->alc3 = $request->alc3;
        $calendseguimto->justificacion = $request->justificacion;
        $calendseguimto->areaoperadora = $request->areaoperadora;
        $calendseguimto->user_id = Auth::user()->id;
        $calendseguimto->save();
    }

    // Función que contiene la lógica para actualizar un registro
    public function update(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        $calendseguimto = Calendseguimtos::findOrFail($request->id);
        $calendseguimto->datoespecificos_id = $request->datoespecificos_id;
        $calendseguimto->actividad = $request->actividad;
        $calendseguimto->unidadmedida = $request->unidadmedida;
        $calendseguimto->metaanual = $request->metaanual;
        $calendseguimto->prog1 = $request->prog1;
        $calendseguimto->alc1 = $request->alc1;
        $calendseguimto->prog2 = $request->prog2;
        $calendseguimto->alc2 = $request->alc2;
        $calendseguimto->prog3 = $request->prog3;
        $calendseguimto->alc3 = $request->alc3;
        $calendseguimto->justificacion = $request->justificacion;
        $calendseguimto->areaoperadora = $request->areaoperadora;
        $calendseguimto->save();
    }

    // Función que contiene la lógica para eliminar un registro
    public function destroy(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        $calendseguimto = Calendseguimtos::findOrFail($request->id);
        $calendseguimto->delete();
    }

    // Función que contiene la lógica para llenar el campo select datos específicos
    public function selectDatosespecificos(Request $request){
        if(!$request->ajax()) return redirect('/');
        if(Auth::user()->rol == 'Administrador'){
            $datoespecifico = Datosespecificos::select('id','denoindicador')
                            // ->orderBy('dato_especificos.id', 'asc')
                            ->from('dato_especificos')->get();
        }
        if(Auth::user()->rol == 'Trabajador'){
            $datoespecifico = Datosespecificos::select('id','denoindicador')
                            ->where('user_id', Auth::user()->id)
                            ->from('dato_especificos')->get();
        }
        return ['dato_especificos' => $datoespecifico];
    }
}
