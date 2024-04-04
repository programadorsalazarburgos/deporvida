<?php

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

Route::get('/home', 'HomeController@index')->name('home');


Route::get('index-noticias', function () {
    return view('postnoticias.index');
  });
  Route::group(["prefix" => "api/v0"], function () {
    Route::get("admin/postnoticias", "PostNoticiasController@index");
  });
  Route::get('create-noticias', function () {
    return view('postnoticias.create');
  });
  Route::get('editar-noticias', function () {
    return view('postnoticias.editar');
  });
  Route::get('admin/postnoticias', 'PostNoticiasController@vista');
  Route::get('/api/v0/obtener/noticia/{id}', 'PostNoticiasController@obtenernoticia');
  Route::get('/api/v0/admin/postnoticias/{id}', 'PostNoticiasController@obtenernoticias');
  Route::post('/api/v0/postnoticias/editarNoticias/{id}', 'PostNoticiasController@actualizarnoticia');

  Route::post('/api/v0/eliminar/noticia/{id}', 'PostNoticiasController@eliminar');
  Route::get('/api/v0/obtenerselect/categorias', 'PostNoticiasController@obtenercategorias');

  Route::get('/api/v0/obtenerselect/categorias/{id}', 'PostNoticiasController@obtenercategoriasID');

  Route::post('/api/v0/postnoticias/create', 'PostNoticiasController@crear');
  Route::post('/api/v0/agregar/principal/{id}', 'PostNoticiasController@agregarPrincipal');
  Route::post('/api/v0/agregar/secundaria/{id}', 'PostNoticiasController@agregarSecundaria');
  Route::post('/api/v0/eliminar/princial/{id}', 'PostNoticiasController@eliminarprincipal');
  Route::post('/api/v0/eliminar/secundaria/{id}', 'PostNoticiasController@eliminarsecundaria');
  Route::post('/api/v0/adjunar/archivos/{id}', 'PostNoticiasController@adjuntararchivos');
  Route::get('/api/v0/obtener/adjuntados/{id}', 'PostNoticiasController@obteneradjuntados');




