<?php

use App\Http\Controllers\tipoHabitacionesController;
use Illuminate\Support\Facades\Route;

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
Route::get('/habitaciones', function () {
    return view('content.habitaciones');
});
Route::get('/reservaciones', function () {
    return view('content.reservaciones');
});
Route::get('/usuarios', function () {
    return view('administrador.usuarios');
});
Route::get('/productos', function () {
    return view('administrador.productos');
});
Route::get('/categorias', [tipoHabitacionesController::class, 'index'])->name('categorias.index');
Route::post('/tipo-habitacion', [tipoHabitacionesController::class, 'store'])->name('tipo-habitacion.store');
Route::put('/tipo-habitacion/{id}', [tipoHabitacionesController::class, 'update'])->name('tipo-habitacion.update');
Route::delete('/tipo-habitacion/{id}', [tipoHabitacionesController::class, 'destroy'])->name('tipo-habitacion.destroy');


Route::get('/pedidos', function () {
    return view('administrador.pedidos');
});
