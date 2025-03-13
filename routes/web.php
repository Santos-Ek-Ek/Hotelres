<?php

use App\Http\Controllers\tipoHabitacionesController;
use App\Http\Controllers\HabitacionesController;
use App\Http\Controllers\PagoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReservaController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', function () {
    return view('content.inicio');
});
Route::get('/hotel', function () {
    return view('content.hotel');
});
Route::get('/habitacion', function () {
    return view('content.habitaciones');
});
Route::get('/reservaciones', function () {
    return view('content.reservaciones');
});
Route::get('/pagos',[PagoController::class,'index']);
Route::post('/actualizar-estado/{id}', [PagoController::class, 'update'])->name('actualizar.estado');


Route::get('/categorias', [tipoHabitacionesController::class, 'index'])->name('categorias.index');
Route::post('/tipo-habitacion', [tipoHabitacionesController::class, 'store'])->name('tipo-habitacion.store');
Route::put('/tipo-habitacion/{id}', [tipoHabitacionesController::class, 'update'])->name('tipo-habitacion.update');
Route::delete('/tipo-habitacion/{id}', [tipoHabitacionesController::class, 'destroy'])->name('tipo-habitacion.destroy');

Route::post('/habitaciones_agregar', [HabitacionesController::class, 'store'])->name('habitaciones.store');
Route::put('/habitaciones/{id}', [HabitacionesController::class, 'update'])->name('habitaciones.update');
Route::get('/habitacion_vista', [HabitacionesController::class, 'index'])->name('habitacion.index');
Route::delete('/habitaciones/imagenes/{id}', [HabitacionesController::class, 'eliminarImagen'])->name('habitaciones.imagenes.eliminar');
Route::get('/habitaciones/{id}/edit', [HabitacionesController::class, 'edit'])->name('habitaciones.edit');
Route::delete('/eliminar_habitacion/{id}', [HabitacionesController::class, 'destroy'])->name('habitaciones.destroy');


Route::get('/buscar-habitaciones', [HabitacionesController::class, 'buscarHabitaciones']);


Route::post('/reservas', [ReservaController::class, 'store']);
Route::get('/reservacion', [ReservaController::class, 'index']);
Route::get('/huespedes', [ReservaController::class, 'huesped']);
Route::post('/actualizar-estado-reserva/{id}', [ReservaController::class, 'update'])->name('actualizar.reserva.estado');


