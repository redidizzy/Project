<?php

namespace App\Http\Repositories;

use Illuminate\Support\Facades\Auth;

use App\OffreEmploi;
use App\TypeOuvrier;
	

class OffreRepository{
	public function getOffresEntrepreneur($entrepreneur)
	{
		$offres = $entrepreneur->offres()->paginate(5);
		$resultat = [$offres, $offres->render()];
		return $resultat;
	}
	public function toutLesTypesOuvriers()
	{
		return TypeOuvrier::all();
	}
	public function creerOffre($request)
	{
		$utilisateur=Auth::user()->userable->id;
	   	OffreEmploi::create([
			'type_id' => TypeOuvrier::find($request->type)->designation,
			'entrepreneur_id' => $utilisateur,
			'contenu' => $request->contenu
		]);

		return Auth::user()->id;
	}
	public function getOffre($id)
	{
		return OffreEmploi::find($id);
	}
	public function changerOffre($request, $id)
	{
		$offre=OffreEmploi::find($id);
		
		$offre->type_id = TypeOuvrier::where('designation', '=', $request->type)->first()->designation;
		$offre->contenu = $request->contenu;
		
		$offre->save();

		return Auth::user()->id;
	}
	public function supprimerOffre($id)
	{
		$offre = OffreEmploi::find($id);
		$offre->ouvriers()->detach();
		$offre->delete();
		return Auth::user()->id;
	}
	public function getPostulants($offre)
	{
		return $offre->ouvriers;
	}
	public function getOffresPourOuvrier()
	{
		$user= Auth::user();
		
		
		$typeUser = $user->userable->fonction;
		$result = OffreEmploi::where('type_id', '=',$typeUser)->paginate(5);
		
		return ['offres'=>$result, 'links' =>$result->render()];
	}
	public function postuler($id_offre)
	{
		$offre = OffreEmploi::find($id_offre);
		$offre->ouvriers()->attach(Auth::user()->userable);
	}
}