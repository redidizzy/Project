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
})->name('welcome')->middleware('guest');

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


//ces routes concerneront les demandes
Route::resource('/{id}/demandes', 'DemandeController',['except' => ['create', 'update', 'destroy', 'edit']]);
Route::get('demandes/create', 'DemandeController@create')->name('demandes.create');
Route::get('/demandes/{id}/edit', 'DemandeController@edit')->name('demandes.edit');
Route::delete('/demandes/{id}/', 'DemandeController@destroy')->name('demandes.destroy');
Route::post('/demandes/{id}', 'DemandeController@update')->name('demandes.update');


//ces routes concerneront les offres
Route::resource('/{id}/offres', 'OffreController',['except' => ['create', 'update', 'destroy', 'edit']]);
Route::get('offres/create', 'OffreController@create')->name('offres.create');
Route::get('/offres/{id}/edit', 'OffreController@edit')->name('offres.edit');
Route::delete('/offres/{id}/', 'OffreController@destroy')->name('offres.destroy');
Route::post('/offres/{id}', 'OffreController@update')->name('offres.update');
Route::get('/offres/{id}/postuler', 'OffreController@addPostulant')->name('offres.addPostulant');
Route::get('/offres/{id}/postulants', 'OffreController@afficherPostulants')->name('offres.afficherPostulants');
