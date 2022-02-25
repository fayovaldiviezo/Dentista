<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InicioController;
use App\Http\Controllers\ConsultoriosController;
use App\Http\Controllers\DoctoresController;
use App\Http\Controllers\PacientesController;
use App\Http\Controllers\CitasController;



Route::get('/', function () {
    return view('modulos.Seleccionar');
});

Route::get('/Ingresar', function () {
    return view('modulos.Ingresar');
});


Auth::routes();


Route::get('Inicio', [InicioController::class, 'index']);
Route::get('Consultorios', [ConsultoriosController::class, 'index']);
Route::post('Consultorios', [ConsultoriosController::class, 'store']);
Route::put('Consultorio/{id}', [ConsultoriosController::class, 'update']);
Route::delete('borrar-Consultorio/{id}', [ConsultoriosController::class, 'destroy']);


// ver consultorios como paciente
Route::get('Ver-Consultorios',[ConsultoriosController::class, 'verConsultorios']);


Route::get('Doctores', [DoctoresController::class, 'index']);
Route::post('Doctores', [DoctoresController::class, 'store']);
Route::get('Eliminar-Doctor/{id}', [DoctoresController::class, 'destroy']);

// Ver doctores como paciente
Route::get('Ver-Doctores/{id}',[DoctoresController::class,'VerDoctores']);

Route::get('Pacientes', [PacientesController::class, 'index']);
Route::get('Crear-Paciente', [PacientesController::class, 'create']);
Route::post('Crear-Paciente', [PacientesController::class, 'store']);
Route::get('Editar-Paciente/{id}', [PacientesController::class, 'edit']);
Route::PUT('actualizar-paciente/{paciente}', [PacientesController::class, 'update']);
Route::get('Eliminar-Paciente/{id}', [PacientesController::class, 'destroy']);

Route::get('Citas/{id}',[CitasController::class,'index']);
Route::post('Horario',[CitasController::class,'HorarioDoctor']);
Route::put('editar-horario/{id}',[CitasController::class,'EditarHorario']);
Route::post('Citas/{id_doctor}',[CitasController::class,'CrearCita']);
Route::delete('borrar-cita',[CitasController::class, 'destroy']);