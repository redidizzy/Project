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

//cette route permettra a l'utilisateur d'editer son profil 
Route::get('/profil/edit', 'UtilisateurController@edit')->name('utilisateur.edit');
Route::post('/profil/{id}', 'UtilisateurController@saveChange')->name('utilisateur.saveChange');


//cette route permettra a l'utilisateur de voir son/un profil
Route::get('/profil/{id}', 'UtilisateurController@show')->name('utilisateur.profil');





