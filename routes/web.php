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
Route::post('/changeEntrepreneurInfo', 'UtilisateurController@changeEntrepreneurInfo')->name('ajouterInfoEntreprise');
Route::post('/changeDispoEntrepreneur', 'UtilisateurController@changeEntrepreneurDispo')->name('changerDispoEntrepreneur');
Route::post('/changePassword', 'UtilisateurController@changePassword')->name('changePassword');	
Route::post('/AjouterAttestation', 'UtilisateurController@addAttestation')->name('AjouterAttestation');
Route::post('changerProfession', 'UtilisateurController@changerProfession')->name('changerProfession');
Route::post('/ajouterDiplome', 'UtilisateurController@addDiplome')->name('ajouteDiplome');
Route::post('changerPrix', 'UtilisateurController@changerPrix')->name('changerPrix');

//cette route permettra a l'utilisateur de voir son/un profil
Route::get('/profil/{id}', 'UtilisateurController@show')->name('utilisateur.profil');

//cette route servira aux signalements d'utilisateur
Route::put('/signaler/{id}', 'UtilisateurController@signaler')->name('utilisateur.signaler');

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
Route::get('/demandes/touteslesdemandes','DemandeController@demandePourEntreClient')->name('demandes.demandePourEntreClient');


//Ces routes concernent tout ce qui est ajax
Route::get('ajax/getCommunes/{id}', function($id){
	return config('variables.communes.'.$id);
});

//ces routes concerneront les offres
Route::resource('/{id}/offres', 'OffreController',['except' => ['create', 'update', 'destroy', 'edit']]);
Route::get('offres/create', 'OffreController@create')->name('offres.create');
Route::get('/offres/{id}/edit', 'OffreController@edit')->name('offres.edit');
Route::delete('/offres/{id}/', 'OffreController@destroy')->name('offres.destroy');
Route::post('/offres/{id}', 'OffreController@update')->name('offres.update');
Route::get('/offres/{offre}/postulants/{postulant}', 'OffreController@addPostulant')->name('offres.addPostulant');
Route::get('/offres/{id}/postulants', 'OffreController@afficherPostulants')->name('offres.afficherPostulants');
Route::get('/offres/{id}/offrepourouvrier', 'OffreController@offrePourOuvrier')->name('offres.offrePourOuvrier');


//ces routes concerneront l'administration
Route::get('/admin', 'AdminController@index')->name('admin.index');
Route::post('/creerTypeProjet', 'AdminController@creerTypeProjet')->name('creerTypeProjet');
Route::post('/creerTypeOuvrier', 'AdminController@creerTypeOuvrier')->name('creerTypeOuvrier');
Route::get('/makeAdmin', 'AdminController@makeAdmin')->name('makeAdmin');
Route::get('/ban/{id}', 'AdminController@ban')->name('ban');
Route::get('/unban/{id}', 'AdminController@unban')->name('unban');
Route::get('banned', function(){
	return view('isBanned');
})->name('banned');



