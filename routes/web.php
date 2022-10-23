<?php

use App\Http\Controllers\clientes_controller;
use App\Http\Controllers\Productos;
use App\Http\Controllers\Politicas;
use App\Http\Controllers\Ventas;
use App\Http\Controllers\Detalles;
use App\Models\mod_pro;
use App\Models\mod_ventas;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cookie;
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
////////////////////Politicas//////////////////
Route::get('politicas', [Politicas::class, 'lista'])->name('m.politicas');

Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);

	
	Route::get('upgrade', function () {return view('pages.upgrade');})->name('upgrade'); 
	Route::get('map', function () {return view('pages.maps');})->name('map');
	Route::get('icons', function () {return view('pages.icons');})->name('icons'); 
	Route::get('table-list', function () {return view('pages.tables');})->name('table');
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
	
	Route::get('clientes', [clientes_controller::class, 'lista'])->name('m.clientes')->middleware('verificar_perfil');
	Route::get('clientes/lista', [clientes_controller::class, 'lista_clientes'])->middleware('verificar_perfil');
	Route::post('api/cliente/guardar', [clientes_controller::class, 'guardar_cliente'])->middleware('verificar_perfil');
	Route::post('api/cliente/eliminar', [clientes_controller::class, 'eliminar_cliente'])->middleware('verificar_perfil');

	////////////////////Productos//////////////////
	Route::get('productos', [Productos::class, 'lista'])->name('m.productos');

	Route::get('productos/lista', [Productos::class, 'lista_productos']);

	Route::post('api/producto/guardar', [Productos::class, 'guardar_producto']);

	Route::post('api/producto/eliminar', [Productos::class, 'eliminar_producto']);

	

	////////////////////Ventas//////////////////
	Route::get('ventas', [Ventas::class, 'lista'])->name('m.ventas');


	Route::get('ventas/lista', [Ventas::class, 'lista_ventas']);

	Route::post('api/venta/guardar', [Ventas::class, 'guardar_venta']);

	Route::post('api/venta/eliminar', [Ventas::class, 'eliminar_venta']);

	////////////////////Venta detalles//////////////////
	Route::get('detalles', [Detalles::class, 'lista'])->name('m.detalles');

	Route::get('detalles/lista', [Detalles::class, 'lista_detalles']);

	Route::post('api/detalle/guardar', [Detalles::class, 'guardar_detalle']);

	Route::post('api/detalle/eliminar', [Detalles::class, 'eliminar_detalle']);

	


	});

	$valor = 'jesus';

	Route::get('cookie/crear/{valor}', function ($valor){
        Cookie::queue('mi_cookie', $valor, 120);
        return "Ok";
    });

    Route::get('cookie/leer', function (){
        $val = Cookie::get('mi_cookie');
        return $val;
    });

    Route::get('cookie/borrar', function (){
        $cookie = Cookie::forget('mi_cookie');

        Cookie::queue($cookie);
        return "Ok";
    });


	Route::get('ver_imagen/{id}', function($id){
		$producto = mod_pro::find($id);
		

		$path = $producto->foto_producto;
		$full_path = Storage::path($path);
		$base64 = base64_encode(Storage::get($path));
		$image_data = 'data:'.mime_content_type($full_path) . ';base64,'. $base64;

		return $image_data;

	

});