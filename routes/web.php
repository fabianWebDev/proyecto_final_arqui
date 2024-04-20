<?php

use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\DepartamentoController;
use App\Http\Controllers\PuestoController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HorarioController;
use App\Http\Controllers\AsistenciaController;
use App\Http\Controllers\EvaluacionController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PDFController;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/home', function () {
    // Check if the user is authenticated
    if (Auth::check()) {
        // Check if the user's password has not been changed
        if (Auth::user()->password_updated_at == null) {
            // Redirect to change password route
            return view('profile.password-edit');
        }
    }

    // If the password has been changed or the user is not authenticated, proceed to the 'home' view
    return view('home');
})->middleware(['auth', 'verified'])->name('home');

// Empleado routes

Route::get('/empleado', [EmpleadoController::class, 'index'])->name('empleado.index');

Route::get('/empleado/colillas', [EmpleadoController::class, 'colillas_index'])->name('empleado.colillas');
Route::get('/empleado/descarga/{filename}', [EmpleadoController::class, 'download'])->name('pdf.download');
Route::get('/generate', [EmpleadoController::class, 'generate_pdfs']);

// Route::get('/empleado/{empleado_id}/pdf', [EmpleadoController::class, 'viewPdf']);

Route::get('/empleado/agregar', [EmpleadoController::class, 'create'])->name('empleado.create');

Route::post('/empleado/agregar', [EmpleadoController::class, 'store'])->name('empleado.store');

Route::get('/empleado/{empleado}/editar', [EmpleadoController::class, 'edit'])->name('empleado.edit');

Route::put('/empleado/{empleado}', [EmpleadoController::class, 'update'])->name('empleado.update');

Route::delete('/empleado/{empleado}', [EmpleadoController::class, 'destroy'])->name('empleado.destroy');

// Departamento routes

Route::get('/departamento', [DepartamentoController::class, 'index'])->name('departamento.index');

Route::get('/departamento/agregar', [DepartamentoController::class, 'create'])->name('departamento.create');

Route::post('/departamento/agregar', [DepartamentoController::class, 'store'])->name('departamento.store');

Route::get('/departamento/{departamento}/editar', [DepartamentoController::class, 'edit'])->name('departamento.edit');

Route::put('/departamento/{departamento}', [DepartamentoController::class, 'update'])->name('departamento.update');

Route::delete('/departamento/{departamento}', [DepartamentoController::class, 'destroy'])->name('departamento.destroy');

// Puesto routes

Route::get('/puesto', [PuestoController::class, 'index'])->name('puesto.index');

Route::get('/puesto/agregar', [PuestoController::class, 'create'])->name('puesto.create');

Route::post('/puesto/agregar', [PuestoController::class, 'store'])->name('puesto.store');

Route::get('/puesto/{puesto}/editar', [PuestoController::class, 'edit'])->name('puesto.edit');

Route::put('/puesto/{puesto}', [PuestoController::class, 'update'])->name('puesto.update');

Route::delete('/puesto/{puesto}', [PuestoController::class, 'destroy'])->name('puesto.destroy');

// Perfil routes

Route::get('/perfil', [PerfilController::class, 'index'])->name('perfil.index');

Route::get('/perfil/agregar', [PerfilController::class, 'create'])->name('perfil.create');

Route::post('/perfil/agregar', [PerfilController::class, 'store'])->name('perfil.store');

Route::get('/perfil/{perfil}/editar', [PerfilController::class, 'edit'])->name('perfil.edit');

Route::put('/perfil/{perfil}', [PerfilController::class, 'update'])->name('perfil.update');

Route::delete('/perfil/{perfil}', [PerfilController::class, 'destroy'])->name('perfil.destroy');

// Horario routes

Route::get('/horario', [HorarioController::class, 'index'])->name('horario.index');

Route::get('/horario/agregar', [HorarioController::class, 'create'])->name('horario.create');

Route::post('/horario/agregar', [HorarioController::class, 'store'])->name('horario.store');

Route::get('/horario/{horario}/editar', [HorarioController::class, 'edit'])->name('horario.edit');

Route::put('/horario/{horario}', [HorarioController::class, 'update'])->name('horario.update');

Route::delete('/horario/{horario}', [HorarioController::class, 'destroy'])->name('horario.destroy');

// Asistencia routes

Route::get('/asistencia', [AsistenciaController::class, 'index'])->name('asistencia.index');

Route::post('/asistencia', [AsistenciaController::class, 'store'])->name('asistencia.store');

Route::put('/asistencia', [AsistenciaController::class, 'update'])->name('asistencia.update');

Route::get('/asistencia/control', [AsistenciaController::class, 'control'])->name('asistencia.control');

Route::get('/generate-asistencia', [AsistenciaController::class, 'get_asistencia'])->name('asistencia.get');

// Evaluacion routes

Route::get('/evaluacion', [EvaluacionController::class, 'index'])->name('evaluacion.index');
Route::get('/evaluacion/agregar', [EvaluacionController::class, 'create'])->name('evaluacion.create');
Route::post('/evaluacion/agregar', [EvaluacionController::class, 'store'])->name('evaluacion.store');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
