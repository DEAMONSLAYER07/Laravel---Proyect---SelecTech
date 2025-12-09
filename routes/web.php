<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VacanteController;
use App\Http\Controllers\SolicitudController;
use App\Http\Controllers\Admin\SolicitudController as AdminSolicitudController;
use App\Http\Controllers\RHController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FichaTrabajoController;


/*
|--------------------------------------------------------------------------
| RUTAS PÚBLICAS
|--------------------------------------------------------------------------
*/

// Página principal con vacantes disponibles
Route::get('/', [VacanteController::class, 'index'])->name('home');


/*
|--------------------------------------------------------------------------
| POSTULANTES (FORMULARIO DE SOLICITUD)
|--------------------------------------------------------------------------
*/

// Mostrar formulario para postularse a una vacante
Route::get('/solicitud/{id}', [SolicitudController::class, 'create'])
    ->name('solicitud.create');

// Guardar solicitud enviada por el postulante
Route::post('/solicitud', [SolicitudController::class, 'store'])
    ->name('solicitud.store');

// Página de agradecimiento después de postularse
Route::get('/solicitud/gracias', function () {
    return view('solicitud.gracias');
})->name('solicitud.gracias');


/*
|--------------------------------------------------------------------------
| AUTENTICACIÓN
|--------------------------------------------------------------------------
*/

// Mostrar login
Route::get('/login', [AuthController::class, 'mostrarLogin'])->name('login');

// Procesar login
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

// Cerrar sesión
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


/*
|--------------------------------------------------------------------------
| RUTAS PROTEGIDAS (ACCESO RH)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    /*
    |----------------------------------------------------------
    | REDIRECCIÓN ADMIN → RH DASHBOARD
    |----------------------------------------------------------
    */
    Route::get('/admin/solicitudes', function () {
        return redirect()->route('rh.dashboard');
    })->name('admin.solicitudes.index');


    /*
    |----------------------------------------------------------
    | PANEL RH
    |----------------------------------------------------------
    */

    // Vista principal RH (solicitudes + fichas)
    Route::get('/rh/dashboard', [RHController::class, 'dashboard'])->name('rh.dashboard');

    // Ver detalles completos de una solicitud
    Route::get('/rh/solicitud/{id}', [RHController::class, 'verSolicitud'])->name('rh.verSolicitud');

    // Cambiar estado de ficha desde perfil RH (Contratado / Rechazado)
    Route::post('/rh/solicitudes/{id}/{estado}', [RHController::class, 'actualizarEstadoFicha'])
        ->name('rh.actualizarEstadoFicha');

    // Guardar una ficha desde el panel
    Route::post('/rh/guardar-ficha', [RHController::class, 'guardarFicha'])->name('rh.guardarFicha');

    Route::post('/rh/solicitud/{id}/asignar-ficha', [RHController::class, 'asignarFicha'])
    ->name('rh.asignarFicha');

    
    // Guardar vacantes (versión antigua del sistema)
    Route::post('/rh/vacantes/guardar', [RHController::class, 'guardarVacante'])->name('rh.vacantes.guardar');

    // Eliminar una solicitud
    Route::delete('/rh/solicitudes/{id}', [RHController::class, 'eliminarSolicitud'])
        ->name('rh.solicitudes.eliminar');


    /*
    |--------------------------------------------------------------------------
    | CRUD COMPLETO DE FICHAS DE TRABAJO
    |--------------------------------------------------------------------------
    */

    // Listado de fichas
    Route::get('/rh/fichas', [FichaTrabajoController::class, 'index'])->name('fichas.index');

    // Crear ficha
    Route::get('/rh/fichas/crear', [FichaTrabajoController::class, 'create'])->name('fichas.create');
    Route::post('/rh/fichas', [FichaTrabajoController::class, 'store'])->name('fichas.store');

    // Editar ficha
    Route::get('/rh/fichas/{id}/editar', [FichaTrabajoController::class, 'edit'])->name('fichas.edit');
    Route::put('/rh/fichas/{id}', [FichaTrabajoController::class, 'update'])->name('fichas.update');

    // Eliminar ficha
    Route::delete('/rh/fichas/{id}', [FichaTrabajoController::class, 'destroy'])->name('fichas.destroy');


    /*
    |--------------------------------------------------------------------------
    | CRUD COMPLETO DE VACANTES (NUEVO)
    |--------------------------------------------------------------------------
    */

    // Lista completa para RH
    Route::get('/rh/vacantes', [VacanteController::class, 'indexRh'])
        ->name('rh.vacantes');

    // Crear vacante
    Route::get('/rh/vacantes/crear', [VacanteController::class, 'createForm'])
        ->name('rh.vacantes.create');
    Route::post('/rh/vacantes', [VacanteController::class, 'store'])
        ->name('rh.vacantes.store');

    // Editar vacante
    Route::get('/rh/vacantes/{id}/editar', [VacanteController::class, 'edit'])
        ->name('rh.vacantes.edit');
    Route::put('/rh/vacantes/{id}', [VacanteController::class, 'update'])
        ->name('rh.vacantes.update');

    // Eliminar vacante
    Route::delete('/rh/vacantes/{id}', [VacanteController::class, 'destroy'])
        ->name('rh.vacantes.destroy');
});
