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

// --------------------Rutas de usuario--------------------\\
//Ruta que hace referencia a la función encargada de mostrar contenido del data table
Route::get('/usuario', [App\Http\Controllers\UserController::class, 'index']);
//Ruta que hace referencia a la función que contiene la lógica para registrar un usuario
Route::post('/usuario/registrar', [App\Http\Controllers\UserController::class, 'store']);
//Ruta que hace referencia a la función que contiene la lógica para actualizar un usuario
Route::put('/usuario/actualizar', [App\Http\Controllers\UserController::class, 'update']);
//Ruta que hace referencia a la función que contiene la lógica para eliminar un usuario
Route::delete('/usuario/eliminar/{id}', [App\Http\Controllers\UserController::class, 'destroy']);