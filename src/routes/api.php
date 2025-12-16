<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
// Importar el controlador EventoController
use App\Http\Controllers\EventoController;

/**
* Rutas para el recurso Evento.
*/
// Recuperar todos los eventos
Route::get('/eventos', [EventoController::class, 'index']);
// Almacenar un evento nuevo
Route::post('/eventos', [EventoController::class, 'store']);
// Recuperar un evento específico
Route::get('/eventos/{id}', [EventoController::class, 'show']);
// Actualizar un evento específico
Route::put('/eventos/{evento}', [EventoController::class, 'update']);
// Eliminar un evento específico
Route::delete('/eventos/{id}', [EventoController::class, 'destroy']);

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Ejemplo de ruta de usuario autenticado
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// ----------------------------------------------------
// RUTAS PARA LA GESTIÓN DE EVENTOS (API RESTful)
// ----------------------------------------------------

/*
| La función Route::apiResource crea automáticamente las siguientes rutas:
|
| - GET      /api/eventos        -> index()    (Listar todos)
| - POST     /api/eventos        -> store()    (Crear nuevo)
| - GET      /api/eventos/{id}   -> show()     (Mostrar uno específico)
| - PUT/PATCH /api/eventos/{id}   -> update()   (Actualizar)
| - DELETE   /api/eventos/{id}   -> destroy()  (Eliminar)
*/

Route::apiResource('eventos', EventoController::class);

// Nota: Si solo se necesitaran ciertas rutas, se podría usar:
// Route::apiResource('eventos', EventoController::class)->only(['index', 'show', 'store']);