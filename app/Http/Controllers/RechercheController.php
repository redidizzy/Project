<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Client;
use App\Projet;
use App\TypeProjet;
use App\TypeOuvrier;
use App\Ouvrier;
use App\Entrepreneur;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Collection;

class RechercheController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}
	//le code commence vraiment a devenir illisible, envisager de commencer a faire des repository et a simplifier le code
	public function rapide(Request $researchRequest)
	{
		$recherche = $researchRequest->recherche;
		$resultats; //le resultat sera stocke ici
		//les recherches rapides varieront selon le type de l'utilisateur connecte

		switch(Auth::user()->userable_type)
		{
			case 'Entrepreneur':
				//dans le cas d'un entrepreneur, la recherche rapide concernera les projets

				//pour ce faire, l'utilisateur devra logiquement rechercher le projet par type
				$type = TypeProjet::where('designation', '=', $recherche)->first();
				$resultats = collect();
				//la puissance d'eloquent visible dans  cette instruction :
				if($type != null)
					$resultats = $type->projets;

				// on retourne la vue recherche/rapide.blade.php
				return view('recherche.rapide', compact('resultats'));
				break;

			case 'Ouvrier':
				//dans le cas d'un ouvrier, la recherche rapide concernera aussi les projets
				$type = TypeProjet::where('designation', '=', $recherche)->first();
				$resultats = $type->projets;
				return view('recherche.rapide', compact('resultats'));
				break;
			case 'Client':
				//dans le cas d'un client, la recherche rapide concernera les entrepreneurs
				$entrepreneurs = collect();
				foreach(Entrepreneur::dispo() as $d)
				{
					if($d->user->nom == $recherche or $d->user->prenom == $recherche)
					$entrepreneurs->push($d->user);
				}
				
				return view('recherche.rapide.entrepreneur', compact('entrepreneurs'));
		}
		
	}
    public function rechercheDeProjet()
    {
    	$projets = Projet::all();
    	$types = TypeProjet::all();
    	return view('recherche.projet', compact('projets', 'types'));
    }
    public function rechercheDeProjetFiltre(Request $recherche)
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
    	return view('recherche.projet', ['projets' => $resultat->get(), 'types' => TypeProjet::all()]);
    }
    public function rechercheOuvrier()
    {
        $ouvriers = Ouvrier::all();
        $types = TypeOuvrier::all();

        return view('recherche.ouvrier', compact('ouvriers', 'types'));
    }
    public function rechercheOuvrierFiltre(Request $recherche)
    {
        $resultat = new Ouvrier;
        if($recherche->nom != null)
        {
            $resultat = $resultat->nom($recherche->nom);
        }
        if($recherche->prenom != null)
        {
            $resultat = $resultat->prenom($recherche->prenom);
        }
        if($recherche->reputationMin != null)
        {
            $resultat = $resultat->reputation('>=', $recherche->reputationMin);
        }
        if($recherche->reputationMax!= null)
        {
            $resultat = $resultat->reputation('<=', $recherche->reputationMax);
        }
        if($recherche->prixApproxMin != null)
        {
            $resultat = $resultat->prixApprox('>=', $recherche->prixApproxMin);
        }
        if($recherche->prixApproxMax != null)
        {
            $resultat = $resultat->prixApprox('<=', $recherche->prixApproxMax);
        }
         if($recherche->experienceMin != null)
        {
            $resultat = $resultat->experience('>=', $recherche->experienceMin);
        }
        if($recherche->experienceMax != null)
        {
            $resultat = $resultat->experience('<=', $recherche->experienceMax);
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
            $resultat = $resultat->fonction($recherche->type);
        }
        if(isset($recherche->diplome))
        {
            $resultat = $resultat->diplome(1);
        }

        return view('recherche.ouvrier', ['ouvriers' => $resultat->get(), 'types' => TypeOuvrier::all()]);

    }
    public function rechercheEntrepreneur()
    {
        $entrepreneurs = Entrepreneur::all();
        return view('recherche.entrepreneur', compact('entrepreneurs'));
    }
    public function rechercheEntrepreneurFiltre()
    {
        $resultat = new Entrepreneur;
        if($recherche->nom != null)
        {
            $resultat = $resultat->nom($recherche->nom);
        }
        if($recherche->prenom != null)
        {
            $resultat = $resultat->prenom($recherche->prenom);
        }
        if($recherche->reputationMin != null)
        {
            $resultat = $resultat->reputation('>=', $recherche->reputationMin);
        }
        if($recherche->reputationMax!= null)
        {
            $resultat = $resultat->reputation('<=', $recherche->reputationMax);
        }
        if($recherche->dispoMin != null)
        {
            $resultat = $resultat->dispo('>=', $recherche->dispoMin);
        }
        if($recherche->DispoMax != null)
        {
            $resultat = $resultat->prixApprox('<=', $recherche->dispoMax);
        }
         if($recherche->experienceMin != null)
        {
            $resultat = $resultat->experience('>=', $recherche->experienceMin);
        }
        if($recherche->experienceMax != null)
        {
            $resultat = $resultat->experience('<=', $recherche->experienceMax);
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
            $resultat = $resultat->fonction($recherche->type);
        }
        if(isset($recherche->diplome))
        {
            $resultat = $resultat->diplome(1);
        }

        return view('recherche.ouvrier', ['ouvriers' => $resultat->get(), 'types' => TypeOuvrier::all()]);
    }
}
