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
Route::post('/changeEntrepreneurInfo', 'UtilisateurController@changeEntrepreneurInfo')->name('ajouterInfoEntreprise');
Route::post('/changeDispoEntrepreneur', 'UtilisateurController@changeEntrepreneurDispo')->name('changerDispoEntrepreneur');
Route::post('/changePassword', 'UtilisateurController@changePassword')->name('changePassword');	
RoutesAjouterAttestationEntrepreneu

//cette route permettra a l'utilisateur de voir son/un profil
Route::get('/profil/{id}', 'UtilisateurController@show')->name('utilisateur.profil');

//ces routes concerneront la recherche
Route::post('/rechercheRapide', 'RechercheController@rapide')->name('recherche.rapide');

Route::get('/recherche/projets', 'RechercheController@rechercheDeProjet')->name('recherche.projet');
Route::post('/recherche/projets', 'RechercheController@rechercheDeProjetFiltre')->name('doRecherche.projet');

Route::get('/recherche/ouvriers', 'RechercheController@rechercheOuvrier')->name('recherche.ouvrier');
Route::post('/recherche/ouvriers', 'RechercheController@RechercheOuvrierFiltre')->name('doRecherche.ouvrier');

Route::get('/recherche/entrepreneurs', 'RechercheController@rechercheEntrepreneur')->name('recherche.entrepreneur');
Route::post('/recherche/entrepreneurs', 'RechercheController@RechercheEntrepreneurFiltre')->name('doRecherche.entrepreneur');

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


//Ces routes concernent tout ce qui est ajax
Route::get('ajax/getCommunes/{id}', function($id){
	return config('variables.communes.'.$id);
});