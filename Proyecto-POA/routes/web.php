<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Aqui se registran rutas para la aplicación
|
*/

// Ruta para tablero
Route::get('/main', function () {
    return view('contenido/contenido');
})->name('main');

// --------------------Rutas de autenticación--------------------\\
// Ruta que hace referencia a la función encargada de mostrar el login
Route::get('/', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
// Ruta que hace referencia a la función que contiene la lógica del login
Route::post('/', [App\Http\Controllers\Auth\LoginController::class, 'login']);
// Ruta que hace referencia a la función que contiene la lógica del logout
Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

// --------------------Rutas de Datos Basicos de un POA--------------------\\
//Ruta que hace referencia a la función encargada de mostrar contenido del data table
Route::get('/datosBasicos', [App\Http\Controllers\DatosbasicosController::class, 'index']);
//Ruta que hace referencia a la función que contiene la lógica para registrar datos basicos de un poa
Route::post('/datosBasicos/registrar', [App\Http\Controllers\DatosbasicosController::class, 'store']);
//Ruta que hace referencia a la función que contiene la lógica para actualizar datos basicos de un poa
Route::put('/datosBasicos/actualizar', [App\Http\Controllers\DatosbasicosController::class, 'update']);
//Ruta que hace referencia a la función que contiene la lógica para eliminar datos basicos de un poa
Route::delete('/datosBasicos/eliminar/{id}', [App\Http\Controllers\DatosbasicosController::class, 'destroy']);

// --------------------Rutas de Datos Específicos de un POA--------------------\\
//Ruta que hace referencia a la función encargada de mostrar contenido del data table
Route::get('/datosEspecificos', [App\Http\Controllers\DatosespecificosController::class, 'index']);
//Ruta que hace referencia a la función que contiene la lógica para registrar datos específicos de un poa
Route::post('/datosEspecificos/registrar', [App\Http\Controllers\DatosespecificosController::class, 'store']);
//Ruta que hace referencia a la función que contiene la lógica para actualizar datos específicos de un poa
Route::put('/datosEspecificos/actualizar', [App\Http\Controllers\DatosespecificosController::class, 'update']);
//Ruta que hace referencia a la función que contiene la lógica para eliminar datos específicos de un poa
Route::delete('/datosEspecificos/eliminar/{id}', [App\Http\Controllers\DatosespecificosController::class, 'destroy']);
/*Ruta que hace referencia a la función que contiene la lógica para seleccionar la Denominación del proceso 
en el modal para registrar datos específicos de un poa*/
Route::get('/selectDatosbasicos', [App\Http\Controllers\DatosespecificosController::class, 'selectDatosbasicos']);

// -------------Rutas de Calendarizacion y Seguimiento de las principales actividades de un POA-----------------\\
//Ruta que hace referencia a la función encargada de mostrar contenido del data table
Route::get('/calendSeguimtos', [App\Http\Controllers\CalendseguimtosController::class, 'index']);
//Ruta que hace referencia a la función que contiene la lógica para registrar datos específicos de un poa
Route::post('/calendSeguimtos/registrar', [App\Http\Controllers\CalendseguimtosController::class, 'store']);
//Ruta que hace referencia a la función que contiene la lógica para actualizar datos específicos de un poa
Route::put('/calendSeguimtos/actualizar', [App\Http\Controllers\CalendseguimtosController::class, 'update']);
//Ruta que hace referencia a la función que contiene la lógica para eliminar datos específicos de un poa
Route::delete('/calendSeguimtos/eliminar/{id}', [App\Http\Controllers\CalendseguimtosController::class, 'destroy']);
/*Ruta que hace referencia a la función que contiene la lógica para seleccionar la Denominación del proceso 
en el modal para registrar datos específicos de un poa*/
Route::get('/selectDatosespecificos', [App\Http\Controllers\CalendseguimtosController::class, 'selectDatosespecificos']);

// -------------Rutas de Recursos Requeridos para el cumplimiento de las actividades de un POA-----------------\\
//Ruta que hace referencia a la función encargada de mostrar contenido del data table
Route::get('/recursosRequeridos', [App\Http\Controllers\RecursosrequeridosController::class, 'index']);
//Ruta que hace referencia a la función que contiene la lógica para registrar recursos requeridos de un poa
Route::post('/recursosRequeridos/registrar', [App\Http\Controllers\RecursosrequeridosController::class, 'store']);
//Ruta que hace referencia a la función que contiene la lógica para actualizar recursos requeridos de un poa
Route::put('/recursosRequeridos/actualizar', [App\Http\Controllers\RecursosrequeridosController::class, 'update']);
//Ruta que hace referencia a la función que contiene la lógica para eliminar recursos requeridos de un poa
Route::delete('/recursosRequeridos/eliminar/{id}', [App\Http\Controllers\RecursosrequeridosController::class, 'destroy']);
/*Ruta que hace referencia a la función que contiene la lógica para seleccionar la Actividad 
en el modal para registrar recursos requeridos de un poa*/
Route::get('/selectActividad', [App\Http\Controllers\RecursosrequeridosController::class, 'selectActividad']);
/*Ruta que hace referencia a la función que contiene la lógica para seleccionar la Partida presupuestal
en el modal para registrar recursos requeridos de un poa*/
Route::get('/selectPartidapresupuestal', [App\Http\Controllers\RecursosrequeridosController::class, 'selectPartidapresupuestal']);

// --------------------Rutas de Select general para descargar pdf--------------------\\
//Ruta que hace referencia a la función encargada de mostrar contenido del data table
Route::get('/selectGeneral', [App\Http\Controllers\DescargarPdfController::class, 'index']);
Route::get('/selectGeneral/descargarPdf/{id}', [App\Http\Controllers\DescargarPdfController::class, 'descargarPdf'])->name('poa_pdf');

// ----------------------------------Rutas de Partidas Presupuestales-----------------------------------------------\\
//Ruta que hace referencia a la función encargada de mostrar contenido del data table
Route::get('/partidasPresupuestales', [App\Http\Controllers\PartidaspresupuestalesController::class, 'index']);
//Ruta que hace referencia a la función que contiene la lógica para registrar Partidas presupuestales
Route::post('/partidasPresupuestales/registrar', [App\Http\Controllers\PartidaspresupuestalesController::class, 'store']);
//Ruta que hace referencia a la función que contiene la lógica para actualizar Partidas presupuestales
Route::put('/partidasPresupuestales/actualizar', [App\Http\Controllers\PartidaspresupuestalesController::class, 'update']);
//Ruta que hace referencia a la función que contiene la lógica para eliminar Partidas presupuestales
Route::delete('/partidasPresupuestales/eliminar/{id}', [App\Http\Controllers\PartidaspresupuestalesController::class, 'destroy']);

// --------------------Rutas de usuario--------------------\\
//Ruta que hace referencia a la función encargada de mostrar contenido del data table
Route::get('/usuario', [App\Http\Controllers\UserController::class, 'index']);
//Ruta que hace referencia a la función que contiene la lógica para registrar un usuario
Route::post('/usuario/registrar', [App\Http\Controllers\UserController::class, 'store']);
//Ruta que hace referencia a la función que contiene la lógica para actualizar un usuario
Route::put('/usuario/actualizar', [App\Http\Controllers\UserController::class, 'update']);
//Ruta que hace referencia a la función que contiene la lógica para eliminar un usuario
Route::delete('/usuario/eliminar/{id}', [App\Http\Controllers\UserController::class, 'destroy']);