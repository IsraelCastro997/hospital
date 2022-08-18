<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/usuarios','App\Http\Controllers\UserController@index')->name('users.index');
Route::get('/usuarios/all','App\Http\Controllers\UserController@showall')->name('users.showall');
Route::get('/usuarios/editar/{id}','App\Http\Controllers\UserController@showedit')->name('users.edit');
Route::get('/usuarios/detalleone/{id}','App\Http\Controllers\UserController@showone')->name('users.nuevo');
Route::get('/usuarios/agregar','App\Http\Controllers\UserController@create')->name('users.create');
Route::get('/usuarios/detalle/{id}','App\Http\Controllers\UserController@show')->name('users.show');
Route::get('/usuarios/actual','App\Http\Controllers\UserController@actual')->name('users.show');
Route::apiResource('usuarios', 'App\Http\Controllers\UserController');

Route::apiResource('roles', 'App\Http\Controllers\RoleController');

Route::get('/pacientes','App\Http\Controllers\PacienteController@index')->name('pacientes.index');
Route::get('/pacientes/all','App\Http\Controllers\PacienteController@showall')->name('pacientes.showall');
Route::get('/pacientes/editar/{id}','App\Http\Controllers\PacienteController@showedit')->name('pacientes.edit');
Route::get('/pacientes/detalleone/{id}','App\Http\Controllers\PacienteController@showone')->name('pacientes.nuevo');
Route::get('/pacientes/agregar','App\Http\Controllers\PacienteController@create')->name('pacientes.create');
Route::get('/pacientes/detalle/{id}','App\Http\Controllers\PacienteController@show')->name('pacientes.show');
Route::apiResource('pacientes', 'App\Http\Controllers\PacienteController');

Route::get('/historiales','App\Http\Controllers\DiagnoseController@index')->name('historiales.index');
Route::get('/historiales/all','App\Http\Controllers\DiagnoseController@showall')->name('historiales.showall');
Route::get('/historiales/editar/{id}','App\Http\Controllers\DiagnoseController@showedit')->name('historiales.edit');
Route::get('/historiales/detalleone/{id}','App\Http\Controllers\DiagnoseController@showone')->name('historiales.nuevo');
Route::get('/historiales/agregar','App\Http\Controllers\DiagnoseController@create')->name('historiales.create');
Route::get('/historiales/agregar/{id}','App\Http\Controllers\DiagnoseController@patient')->name('historiales.createpat');
Route::get('/historiales/detalle/{id}','App\Http\Controllers\DiagnoseController@show')->name('historiales.show');
Route::apiResource('historiales', 'App\Http\Controllers\DiagnoseController');

// Cirugias 
Route::get('/cirugias','App\Http\Controllers\CirugiasController@index')->name('cirugias.index');
Route::get('/cirugias/all','App\Http\Controllers\CirugiasController@showall')->name('cirugias.showall');
Route::get('/cirugias/editar/{id}','App\Http\Controllers\CirugiasController@showedit')->name('cirugias.edit');
Route::get('/cirugias/detalleone/{id}','App\Http\Controllers\CirugiasController@showone')->name('cirugias.nuevo');
Route::get('/cirugias/agregar','App\Http\Controllers\CirugiasController@create')->name('cirugias.create');
Route::get('/cirugias/detalle/{id}','App\Http\Controllers\CirugiasController@show')->name('cirugias.show');
Route::apiResource('cirugias', 'App\Http\Controllers\CirugiasController');
// Route::get('/cirugias/add','App\Http\Controllers\CirugiasController@show')->name('Cirugias.Add');
// Route::post('/cirugias/add/post','App\Http\Controllers\CirugiasController@postCirugiasAdd');
// Route::get('/cirugias/{id}/detalle','App\Http\Controllers\CirugiasController@detalle');
// Route::get('/cirugias/{id}/edit','App\Http\Controllers\CirugiasController@edit');
// Route::post('/cirugias/edit/{id}','App\Http\Controllers\CirugiasController@postEdit');
// Route::post('/cirugias/{id}/delete','App\Http\Controllers\CirugiasController@delete');
// Route::get('cirugias', 'App\Http\Controllers\CirugiasController@index');
// Route::apiResource('cirugias', 'App\Http\Controllers\CirugiasController');

Route::get('/areas','App\Http\Controllers\AreaController@index')->name('areas.index');
Route::get('/areas/all','App\Http\Controllers\AreaController@showall')->name('areas.showall');
Route::get('/areas/editar/{id}','App\Http\Controllers\AreaController@showedit')->name('areas.edit');
Route::get('/areas/detalleone/{id}','App\Http\Controllers\AreaController@showone')->name('areas.nuevo');
Route::get('/areas/agregar','App\Http\Controllers\AreaController@create')->name('areas.create');
Route::get('/areas/detalle/{id}','App\Http\Controllers\AreaController@show')->name('areas.show');
Route::apiResource('areas', 'App\Http\Controllers\AreaController');

Route::get('/dashboard','App\Http\Controllers\DashBoardController@index')->name('dashboard.index');
Route::get('/dashboard/all','App\Http\Controllers\DashBoardController@showall')->name('dashboard.showall');
Route::get('/dashboard/print','App\Http\Controllers\DashBoardController@print')->name('dashboard.print');


Route::apiResource('archivos', 'App\Http\Controllers\FileController');

Route::get('/horarios','App\Http\Controllers\ScheduleController@index')->name('horarios.index');
Route::get('/horarios/all','App\Http\Controllers\ScheduleController@showall')->name('horarios.showall');
Route::get('/horarios/editar/{id}','App\Http\Controllers\ScheduleController@showedit')->name('horarios.edit');
Route::get('/horarios/detalleone/{id}','App\Http\Controllers\ScheduleController@showone')->name('horarios.nuevo');
Route::get('/horarios/agregar','App\Http\Controllers\ScheduleController@create')->name('horarios.create');
Route::get('/horarios/detalle/{id}','App\Http\Controllers\ScheduleController@show')->name('horarios.show');
Route::get('/horarios/usuarios/{id}','App\Http\Controllers\ScheduleController@changeusers')->name('horarios.changeusers');

Route::apiResource('horarios', 'App\Http\Controllers\ScheduleController');

Route::get('/inventario','App\Http\Controllers\InventaryController@index')->name('inventario.index');
Route::get('/inventario/all','App\Http\Controllers\InventaryController@showall')->name('inventario.showall');
Route::get('/inventario/editar/{id}','App\Http\Controllers\InventaryController@showedit')->name('inventario.edit');
Route::get('/inventario/detalleone/{id}','App\Http\Controllers\InventaryController@showone')->name('inventario.nuevo');
Route::get('/inventario/agregar','App\Http\Controllers\InventaryController@create')->name('inventario.create');
Route::get('/inventario/detalle/{id}','App\Http\Controllers\InventaryController@show')->name('inventario.show');
Route::apiResource('inventario', 'App\Http\Controllers\InventaryController');
