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
	$fonctions = App\TypeOuvrier::all();
    return view('welcome', compact('fonctions'));
})->middleware('guest');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


//cette route permettra a l'utilisateur d'editer son profil 
Route::get('/profil/edit', 'UtilisateurController@edit')->name('utilisateur.edit');
Route::post('/profil/{id}', 'UtilisateurController@saveChange')->name('utilisateur.saveChange');


//cette route permettra a l'utilisateur de voir son/un profil
Route::get('/profil/{id}', 'UtilisateurController@show')->name('utilisateur.profil');

//ces routes concerneront la recherche
Route::post('/rechercheRapide', 'RechercheController@rapide')->name('recherche.rapide');

Route::get('/recherche/projets', 'RechercheController@rechercheDeProjet')->name('recherche.projet');
Route::post('/recherche/projets', 'RechercheController@rechercheDeProjetFiltre')->name('doRecherche.projet');

//ces routes concerneront les projets
Route::resource('/{id}/projets', 'ProjetsController',['except' => ['create', 'update', 'destroy', 'edit']]);
Route::get('projets/create', 'ProjetsController@create')->name('projets.create');
Route::get('/projets/{id}/edit', 'ProjetsController@edit')->name('projets.edit');
Route::delete('/projets/{id}/', 'ProjetsController@destroy')->name('projets.destroy');
Route::post('/projets/{id}', 'ProjetsController@update')->name('projets.update');