<?php

namespace App\Http\Repositories;

use Illuminate\Support\Facades\Auth;

use App\Projet;
use App\TypeProjet;

class ProjetRepository{
	protected $projet, $types;

	public function __construct(Projet $projet, TypeProjet $types)
	{
		$this->projet = $projet;
		$this->types = $types;
	}

	public function getProjetDuClient($client)
	{
		return $client->projets;
	}

	public function creerProjet($request)
	{
		$utilisateur = Auth::user()->userable->id;
		$this->projet->create([
            'type_id' => $this->types->where('designation', '=', $request->type)->first()->id,
            'client_id' => $utilisateur,
            'description' => $request->description,
            'wilaya' => $request->wilaya,
            'region' => $request->region,
            'adresse' => $request->adresse,
            'superficie' => $request->superficie,
            'budget' => $request->budget,
            'delai' => $request->delai,
            'necessiteEntrepreneur' => isset($request->necessiteEntrepreneur)
        ]); 
		return Auth::user()->id;
	}
	public function projetNumero($n)
	{
		return $this->projet->find($n);
	}
	public function toutLesTypes()
	{
		return $this->types->all();
	}
	public function changerProjet($request, $id)
	{
		$projet = $this->projet->find($id);

        $projet->type_id = $this->types->where('designation', '=', $request->type)->first()->id;
        $projet->description = $request->description;
        $projet->wilaya = $request->wilaya;
        $projet->region = $request->region;
        $projet->superficie = $request->superficie;
        $projet->budget = $request->budget;
        $projet->delai = $request->delai;
        $projet->necessiteEntrepreneur = isset($request->necessiteEntrepreneur);

        $projet->save();

        return Auth::user()->id;
	}
	public function supprimerProjet($id)
	{
		$this->projet->find($id)->delete();
		return Auth::user()->id;
	}
	public function creerTypeProjet($request)
	{
		TypeProjet::create([
			'designation' => $request->designation,
			'description' => $request->description
		]);
	}
	public function rechercherProjetRapide($recherche)
	{
		//dans le cas d'un entrepreneur, la recherche rapide concernera les projets

				//pour ce faire, l'utilisateur devra logiquement rechercher le projet par type
				$type = TypeProjet::find($recherche);
				$resultats = collect();
                $links = null;
				//la puissance d'eloquent visible dans  cette instruction :
				if($type != null)
                {
					$resultats = $type->projets()->paginate(5);

                    $links = $resultats->appends(compact('recherche'))->render();
                }

				// on retourne la vue recherche/rapide.blade.php
				return compact('resultats',  'links');
	}
	public function rechercherProjet($recherche = null)
	{
		if(!$recherche)
		{
			$projets = Projet::orderByDesc('created_at')->paginate(5);
        	$links = $projets->render();
    		$types = TypeProjet::all();
    		$return = compact('projets', 'types', 'links');
		}
		else
		{
			$resultat = new Projet;

    	if($recherche->nom != null)
    	{
    		$resultat = $resultat->nomClient($recherche->nom);
    	}
    	if($recherche->prenom != null)
    	{
    		$resultat = $resultat->prenomClient($recherche->prenom);
    	}
    	if($recherche->superficieMin != null)
    	{
    		$resultat = $resultat->superficie('>=', $recherche->superficieMin);
    	}
    	if($recherche->superficieMax != null)
    	{
    		$resultat = $resultat->superficie('<=', $recherche->superficieMax);
    	}
    	if($recherche->budgetMin != null)
    	{
    		$resultat = $resultat->budget('>=', $recherche->budgetMin);
    	}
    	if($recherche->budgetMax != null)
    	{
    		$resultat = $resultat->budget('<=', $recherche->budgetMax);
    	}
    	if($recherche->region != null)
    	{
    		$resultat = $resultat->region($recherche->region);
    	}
    	if($recherche->wilaya != null)
    	{
    		$resultat = $resultat->wilaya($recherche->wilaya);
    	}
    	if(isset($recherche->type) and $recherche->type != null)
    	{
    		$resultat = $resultat->categorie($recherche->type);
    	}
    	if(Auth::user()->userable_type == "Entrepreneur")
            $resultat= $resultat->necessiteEntrepreneur(1);
        else
            $resultat = $resultat->necessiteEntrepreneur(0);

        $resultat = $resultat->paginate(5);
        $appends = [
            'nom' => $recherche->nom, 
            'prenom' => $recherche->prenom,
            'superficieMin' => $recherche->superficieMin,
            'superficieMax' => $recherche->superficieMax,
            'budgetMin' => $recherche->budgetMin,
            'budgetMax' => $recherche->budgetMax,
            'wilaya' => $recherche->wilaya,
            'region' => $recherche->region
        ];
        if(isset($recherche->type))
            $appends['type'] = $recherche->type; 
        $links = $resultat->appends($appends)->render();
        $return = ['projets' => $resultat, 'types' => TypeProjet::all(), 'links' => $links];
		}
		return $return ;
	}


}