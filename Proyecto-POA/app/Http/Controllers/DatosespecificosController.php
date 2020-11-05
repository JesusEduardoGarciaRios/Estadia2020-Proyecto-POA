<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Datosespecificos;
use App\Models\Datosbasicos;
use App\Models\User;

class DatosespecificosController extends Controller
{
    // Función que muestra el contenido del data table
    public function index(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        $datoespecificos = Datosespecificos::join('dato_basicos', 'dato_especificos.datobasicos_id', '=', 'dato_basicos.id')
                            ->select('dato_especificos.id', 'dato_especificos.datobasicos_id', 'dato_especificos.denoindicador', 
                            'dato_especificos.formindicador', 'dato_especificos.fechacumpli', 'dato_especificos.nivelactual', 
                            'dato_especificos.metaalcanzar', 'dato_especificos.primeroavance', 'dato_especificos.segundoavance', 
                            'dato_especificos.terceroavance', 'dato_especificos.estrategia', 'dato_basicos.denoproceso as nombre_denoproceso')
                            // ->where('users.rol', 'Trabajador')
                            ->orderBy('dato_especificos.id', 'desc')->paginate(1);
        
        return [
            'pagination' => [
                'total'        => $datoespecificos->total(),
                'current_page' => $datoespecificos->currentPage(),
                'per_page'     => $datoespecificos->perPage(),
                'last_page'    => $datoespecificos->lastPage(),
                'from'         => $datoespecificos->firstItem(),
                'to'           => $datoespecificos->lastItem(),
            ],
            'dato_especificos' => $datoespecificos
        ];
    }

    // Función que contiene la lógica para almacenar un registro
    public function store(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        $datoespecifico = new Datosespecificos();
        $datoespecifico->datobasicos_id = $request->datobasicos_id;
        $datoespecifico->denoindicador = $request->denoindicador;
        $datoespecifico->formindicador = $request->formindicador;
        $datoespecifico->fechacumpli = $request->fechacumpli;
        $datoespecifico->nivelactual = $request->nivelactual;
        $datoespecifico->metaalcanzar = $request->metaalcanzar;
        $datoespecifico->primeroavance = $request->primeroavance;
        $datoespecifico->segundoavance = $request->segundoavance;
        $datoespecifico->terceroavance = $request->terceroavance;
        $datoespecifico->estrategia = $request->estrategia;
        $datoespecifico->save();
    }

    // Función que contiene la lógica para actualizar un registro
    public function update(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        $datoespecifico = Datosespecificos::findOrFail($request->id);
        $datoespecifico->datobasicos_id = $request->datobasicos_id;
        $datoespecifico->denoindicador = $request->denoindicador;
        $datoespecifico->formindicador = $request->formindicador;
        $datoespecifico->fechacumpli = $request->fechacumpli;
        $datoespecifico->nivelactual = $request->nivelactual;
        $datoespecifico->metaalcanzar = $request->metaalcanzar;
        $datoespecifico->primeroavance = $request->primeroavance;
        $datoespecifico->segundoavance = $request->segundoavance;
        $datoespecifico->terceroavance = $request->terceroavance;
        $datoespecifico->estrategia = $request->estrategia;
        $datoespecifico->save();
    }

    // Función que contiene la lógica para eliminar un registro
    public function destroy(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        $datoespecifico = Datosespecificos::findOrFail($request->id);
        $datoespecifico->delete();
    }

    // Función que contiene la lógica para llenar el campo select datos basicos
    public function selectDatosbasicos(Request $request){
        if(!$request->ajax()) return redirect('/');
        $datobasico = Datosbasicos::select('id','denoproceso')
                            ->from('dato_basicos')->get();
        return ['dato_basicos' => $datobasico];
    }
}
