<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\MascotasController;
use App\Http\Controllers\CitasController;

Route::get('/', function () {
  return view('modulos.users.Ingresar');
});

// Route::get('CrearUsuario', [UsersController::class, 'create']);




Auth::routes();

Route::get('Inicio', [UsersController::class, 'Ajustes']);
Route::post('Inicio', [UsersController::class, 'ActualizarAjustes']);

Route::get('Mis-Datos', function () {
  return view('modulos.users.Mis-Datos');
});

Route::put('Mis-Datos', [UsersController::class, 'ActualizarMisDatos']);
Route::get('Usuarios', [UsersController::class, 'index']);
Route::post('Usuarios', [UsersController::class, 'store']);
Route::get('Editar-Usuario/{id_usuario}', [UsersController::class, 'edit']);
Route::put('Actualizar-Usuario/{id_usuario}', [UsersController::class, 'update']);
Route::get('Eliminar-Usuario/{id_usuario}', [UsersController::class, 'destroy']);

//CLIENTES|//

Route::get('Clientes', [ClientesController::class, 'index']);
Route::get('Crear-Cliente', [ClientesController::class, 'create']);
Route::post('Crear-Cliente', [ClientesController::class, 'store']);
Route::get('Editar-Cliente/{id_cliente}', [ClientesController::class, 'edit']);
Route::put('Actualizar-Cliente/{id_cliente}', [ClientesController::class, 'update']);


//MASCOTAS//

Route::get('Mascotas', [MascotasController::class, 'index']);
Route::post('Mascotas', [MascotasController::class, 'store']);
Route::get('Ver-Mascotas/{id_cliente}', [MascotasController::class, 'VerMascotasCliente']);
Route::get('Editar-Mascota/{id_mascota}', [MascotasController::class, 'edit']);
Route::put('Actualizar-Mascota/{id_mascota}', [MascotasController::class, 'update']);


//VACUNAS//

Route::get('Vacunas/{id_mascota}', [MascotasController::class, 'VacunasMascota']);
Route::post('Vacunas/{id_mascota}', [MascotasController::class, 'AgregarVacuna']);
Route::get('Carnet-Vacunas-PDF/{id_mascota}', [MascotasController::class, 'CarnetVacunasPDF']);
Route::get('Eliminar-Mascota/{id_mascota}', [MascotasController::class, 'destroy']);


//CITAS//


Route::get('Veterinarios', [CitasController::class, 'VerVeterinarios']);
Route::post('Veterinarios', [CitasController::class, 'CrearVeterinarios']);
Route::put('Estado/{id_veterinario}', [CitasController::class, 'CambiarEstadoVeterinario']);


Route::get('Citas', [CitasController::class, 'index']);
Route::get('Calendario/{id_veterinario}', [CitasController::class, 'Calendario']);
