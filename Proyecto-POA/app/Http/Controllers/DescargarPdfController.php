<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Datosbasicos;
use App\Models\Datosespecificos;
use App\Models\Calendseguimtos;
use App\Models\Recursosrequeridos;
use App\Models\Partidaspresupuestales;
use App\Models\User;

class DescargarPdfController extends Controller
{
    // Función que muestra el contenido del data table
    public function index(Request $request)
    {
        // if(!$request->ajax()) return redirect('/');
        $selectgeneral = DB::table('dato_basicos')
            ->join('dato_especificos', 'dato_basicos.id', '=', 'dato_especificos.datobasicos_id')
            ->select('dato_basicos.id', 'dato_basicos.denoproceso', 'dato_basicos.objetivoproceso', 'dato_especificos.denoindicador', 'dato_especificos.formindicador')
            ->where('dato_basicos.user_id', Auth::user()->id)
            ->orderBy('dato_basicos.id', 'asc')->paginate(4);
        return [
            'pagination' => [
                'total'        => $selectgeneral->total(),
                'current_page' => $selectgeneral->currentPage(),
                'per_page'     => $selectgeneral->perPage(),
                'last_page'    => $selectgeneral->lastPage(),
                'from'         => $selectgeneral->firstItem(),
                'to'           => $selectgeneral->lastItem(),
            ],
            'dato_basicos' => $selectgeneral
        ];
    }

    // Funcion que contiene la lógica para almacenar contenido dentro del reporte pdf
    public function descargarPdf(Request $request, $id)
    {
        // Select a la tabla dato_basicos segun el valor del id que viene de la variable $id desde el componente vue POACompleto
        $datobasicos = Datosbasicos::select('dato_basicos.id', 'dato_basicos.denoproceso', 'dato_basicos.numproceso', 
                            'dato_basicos.mejoraproceso', 'dato_basicos.arearesponsable', 'dato_basicos.objetivoproceso',
                            'dato_basicos.pideatencion', 'dato_basicos.problematica')
                            ->where('dato_basicos.id', '=', $id)
                            ->orderBy('dato_basicos.id', 'asc')->take(1)->get();
        // Select a la tabla dato_especificos segun el valor del id que viene de la variable $id desde el componente vue POACompleto
        $datoespecificos = Datosespecificos::join('dato_basicos', 'dato_especificos.datobasicos_id', '=', 'dato_basicos.id')
                            ->select('dato_especificos.id', 'dato_especificos.datobasicos_id', 'dato_especificos.denoindicador', 
                            'dato_especificos.formindicador', 'dato_especificos.fechacumpli', 'dato_especificos.nivelactual', 
                            'dato_especificos.metaalcanzar', 'dato_especificos.primeroavance', 'dato_especificos.segundoavance', 
                            'dato_especificos.terceroavance', 'dato_especificos.estrategia', 'dato_basicos.denoproceso as nombre_denoproceso')
                            ->where('dato_especificos.datobasicos_id', '=', $id)
                            ->orderBy('dato_especificos.datobasicos_id', 'asc')->get();
        // Select a la tabla calend_seguimtos segun el valor del id que viene de la variable $id desde el componente vue POACompleto
        $calendseguimtos = Calendseguimtos::join('dato_especificos', 'calend_seguimtos.datoespecificos_id', '=', 'dato_especificos.id')
                            ->select('calend_seguimtos.id', 'calend_seguimtos.datoespecificos_id', 'calend_seguimtos.actividad', 
                            'calend_seguimtos.unidadmedida', 'calend_seguimtos.metaanual', 'calend_seguimtos.prog1', 
                            'calend_seguimtos.alc1', 'calend_seguimtos.prog2', 'calend_seguimtos.alc2', 
                            'calend_seguimtos.prog3', 'calend_seguimtos.alc3', 'calend_seguimtos.justificacion', 'calend_seguimtos.areaoperadora', 
                            'dato_especificos.denoindicador as nombre_denoindicador')
                            ->where('dato_especificos.datobasicos_id', '=', $id)
                            ->orderBy('dato_especificos.datobasicos_id', 'asc')->get();
        // Select a la tabla recurso_requeridos segun el valor del id que viene de la variable $id desde el componente vue POACompleto
        $recursorequeridos = Recursosrequeridos::join('calend_seguimtos', 'recurso_requeridos.calendseguimtos_id', '=', 'calend_seguimtos.id')
                            ->join('dato_especificos', 'calend_seguimtos.datoespecificos_id', '=', 'dato_especificos.id')
                            ->join('partida_presupuestales', 'recurso_requeridos.partidapresu_id', '=', 'partida_presupuestales.id')
                            ->select('recurso_requeridos.id', 'recurso_requeridos.calendseguimtos_id', 'recurso_requeridos.concepto', 
                            'recurso_requeridos.partidapresu_id', 'recurso_requeridos.unidadmedida', 'recurso_requeridos.cantidad', 
                            'recurso_requeridos.costoaprox', 'calend_seguimtos.actividad as nombre_actividad', 'partida_presupuestales.partidapresu as nombre_partidapresu')
                            // ->SUM('recurso_requeridos.costoaprox')
                            ->where('dato_especificos.datobasicos_id', '=', $id)
                            ->orderBy('dato_especificos.datobasicos_id', 'asc')->get();
        // Sumatoria de la columna costoaprox segun la variable $id
        $total = DB::table('recurso_requeridos')
                            ->join('calend_seguimtos', 'recurso_requeridos.calendseguimtos_id', '=', 'calend_seguimtos.id')
                            ->join('dato_especificos', 'calend_seguimtos.datoespecificos_id', '=', 'dato_especificos.id')
                            ->join('partida_presupuestales', 'recurso_requeridos.partidapresu_id', '=', 'partida_presupuestales.id')
                            ->select(DB::raw('SUM(costoaprox) as Total'))
                            ->where('dato_especificos.datobasicos_id', '=', $id)
                            ->get();

        $pdf = \PDF::loadview('pdf.poapdf', ['datobasicos'=>$datobasicos, 'datoespecificos'=>$datoespecificos, 
                                            'calendseguimtos'=>$calendseguimtos, 'recursorequeridos'=>$recursorequeridos, 'total'=>$total]);
        // Se establece horientación horizontal a las hojas del pdf
        // $pdf->setPaper('A4', 'landscape');
        /*Se retorna la variable pdf apuntando a la funcion download, la cual permite la descarga del pdf
        con su contenido*/
        return $pdf->download('poa.pdf');
    }
}
