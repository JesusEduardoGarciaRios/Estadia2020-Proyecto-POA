<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <!-- <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/> -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte de POA UPV</title>
    <style type="text/css">
        body {
            margin: 0;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            font-size: 0.875rem;
            font-weight: normal;
            line-height: 1.5;
            color: #151b1e;
            /* height:297mm;
       		width:210mm;
          	margin-left: auto;
           	margin-right: auto; */
        }

        .page-break {
            page-break-after: always;
        }

        #logo {
            float: left;
            margin-top: 1%;
            margin-left: 2%;
            margin-right: 2%;
        }

        #imagen {
            width: 100px;
        }

        .derecha {
            float: right;
        }

        div.Contenedor1 {
            border-style: solid;
            border-width: thin;
            background-color: lightgrey;
            /* height: auto; */
            /* overflow: hidden; */
        }

        div.Contenedor2 {
            border-style: solid;
            border-width: thin;
            background-color: lightgrey;
            /* height: auto; */
            /* overflow: hidden; */
        }

        p {
            padding: 2px;
            /* border-style: solid; */
            text-align: justify;
            margin: 1px;
        }

        /* ------Para tablas------ */
        /* .table {
            background-color: transparent;
            border-collapse: collapse;
        } */
        thead {
            border-bottom: solid;
            border-width: thin;
            background-color: lightgrey;
        }

        /* tbody {
            border-style: solid;
        } */
        /* th {
            color: whitesmoke;
        } */
        /* tr {
            border-style: solid;
        } */
        /* .table-bordered th,
        .table-bordered td {
            border: 1px solid;
        } */
        .table-bordered {
            border-style: solid;
            border-width: thin;
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: rgba(0, 0, 0, 0.05);
        }
    </style>
</head>

<body>
    <div id="logo">
        <img src="img/upvlogo2.png" alt="incanatoIT" id="imagen">
    </div>
    <h1>Universidad Politécnica de Victoria</h1>
    <h3>Reporte de POA <span class="derecha"> Fecha descarga: {{now()}}</span></h3>
    <!-- ------------------------------Datos Basicos--------------------------------------->
    <h3>Datos básicos</h3>
    <div class="Contenedor1">
        @foreach ($datobasicos as $d)
        <div class="bloque1">
            <p>
                <strong>Denominación del proceso:</strong>
                <br>{{$d->denoproceso}}
            </p>
        </div>
        <div class="bloque2">
            <p>
                <strong>Número de proceso:</strong> {{$d->numproceso}}
            </p>
        </div>
        <div class="bloque3">
            <p>
                <strong>Tipo de proceso, mejora calidad de:</strong>
                <br>{{$d->mejoraproceso}}
            </p>
        </div>
        <div class="bloque4">
            <p>
                <strong>Área responsable:</strong>
                <br>{{$d->arearesponsable}}
            </p>
        </div>
        <div class="bloque5">
            <p>
                <strong>Objetivo del proceso:</strong>
                <br>{{$d->objetivoproceso}}
            </p>
        </div>
        <div class="bloque6">
            <p>
                <strong>Programa, proceso o proyecto del pide al que se da atención:</strong>
                <br>{{$d->pideatencion}}
            </p>
        </div>
        <div class="bloque7">
            <p>
                <strong>Problemática que atiende el proceso de impacto:</strong>
                <br>{{$d->problematica}}
            </p>
        </div>
        @endforeach
    </div>
    <div class="page-break"></div>
    <!-- ------------------------------Datos Especificos--------------------------------------->
    <h3>Datos específicos</h3>
    <div class="Contenedor2">
        @foreach ($datoespecificos as $de)
        <div class="bloque1">
            <p>
                <strong>Denominación del proceso:</strong>
                <br>{{$de->nombre_denoproceso}}
            </p>
        </div>
        <div class="bloque2">
            <p>
                <strong>Denominación del indicador:</strong>
                <br>{{$de->denoindicador}}
            </p>
        </div>
        <div class="bloque3">
            <p>
                <strong>Fórmula del indicador:</strong>
                <br>{{$de->formindicador}}
            </p>
        </div>
        <div class="bloque4">
            <p>
                <strong>Fecha de cumplimiento de la meta del indicador:</strong>
                <br>{{$de->fechacumpli}}
            </p>
        </div>
        <div class="bloque5">
            <p>
                <strong>Nivel actual:</strong>
                <br>{{$de->nivelactual}}
            </p>
        </div>
        <div class="bloque6">
            <p>
                <strong>Meta a alcanzar:</strong>
                <br>{{$de->metaalcanzar}}
            </p>
        </div>
        <div class="bloque7">
            <p>
                <strong>Avance de cumplimiento de la meta del indicador:</strong>
                <br>Primero: {{$de->primeroavance}}, Segundo: {{$de->segundoavance}}, Tercero: {{$de->terceroavance}}
            </p>
        </div>
        <div class="bloque6">
            <p>
                <strong>Estrategia(s):</strong>
                <br>{{$de->estrategia}}
            </p>
        </div>
        @endforeach
    </div>
    <div class="page-break"></div>
    <!-----------------------Calendarización y Seguimiento de Actividades----------------------->
    <h3>Calendarización y seguimiento de las principales actividades</h3>
    <table id="stri" class="table table-bordered table-striped table-sm">
        <thead>
            <tr>
                <th>Denom. indicador</th>
                <th>Actividades</th>
                <th>Unidad de medida</th>
                <th>Meta anual</th>
                <th>Prog 1</th>
                <th>Alc 1</th>
                <th>Prog 2</th>
                <th>Alc 2</th>
                <th>Prog 3</th>
                <th>Alc 3</th>
                <th>Justificación</th>
                <th>Área Oper.</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($calendseguimtos as $c)
            <tr>
                <td>{{$c->nombre_denoindicador}}</td>
                <td>{{$c->actividad}}</td>
                <td>{{$c->unidadmedida}}</td>
                <td>{{$c->metaanual}}</td>
                <td>{{$c->prog1}}</td>
                <td>{{$c->alc1}}</td>
                <td>{{$c->prog2}}</td>
                <td>{{$c->alc2}}</td>
                <td>{{$c->prog3}}</td>
                <td>{{$c->alc3}}</td>
                <td>{{$c->justificacion}}</td>
                <td>{{$c->areaoperadora}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="page-break"></div>
    <!------------------------------- Recursos Requeridos ---------------------------------->
    <h3>Recursos requeridos para el cumplimiento de las actividades</h3>
    <table class="table table-bordered table-striped table-sm">
        <thead>
            <tr>
                <th>Actividad</th>
                <th>Concepto</th>
                <th>Partida presupuestal</th>
                <th>Unidad de medida</th>
                <th>Cantidad</th>
                <th>Costo aprox.</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($recursorequeridos as $r)
            <tr>
                <td>{{$r->nombre_actividad}}</td>
                <td>{{$r->concepto}}</td>
                <td>{{$r->nombre_partidapresu}}</td>
                <td>{{$r->unidadmedida}}</td>
                <td>{{$r->cantidad}}</td>
                <td>{{$r->costoaprox}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="derecha">
        <p><strong>Total costo aprox: </strong>{{$total}}</p>
    </div> 
</body>

</html>