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
        $this->middleware('isBanned');
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
                $links = null;
				//la puissance d'eloquent visible dans  cette instruction :
				if($type != null)
                {
					$resultats = $type->projets()->paginate(5);

                    $links = $resultats->appends(compact('recherche'))->render();
                }

				// on retourne la vue recherche/rapide.blade.php
				return view('recherche.rapide', compact('resultats', 'links'));
				break;

			case 'Ouvrier':
				//dans le cas d'un ouvrier, la recherche rapide concernera aussi les projets
				$type = TypeProjet::where('designation', '=', $recherche)->first();
                $resultats = collect();
                $links = null;

                if($type!=null){
				    $resultats = $type->projets()->paginate(5);
                    $links = $resultats->appends(compact('recherce'))->render();
                }


				return view('recherche.rapide', compact('resultats','links'));
				break;
			case 'Client':
				//dans le cas d'un client, la recherche rapide concernera les entrepreneurs
				$entrepreneurs = collect();
				$entrepreneurs = User::where('nom', $recherche)->orWhere('prenom', $recherche)->paginate(5);
                $links = $entrepreneurs->appends(compact('recherche'))->render();
				
				return view('recherche.rapide.entrepreneur', compact('entrepreneurs', 'links'));
		}
		
	}
    public function rechercheDeProjet()
    {
    	$projets = Projet::paginate(5);
        $links = $projets->render();
    	$types = TypeProjet::all();
    	return view('recherche.projet', compact('projets', 'types', 'links'));
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
    	return view('recherche.projet', ['projets' => $resultat, 'types' => TypeProjet::all(), 'links' => $links]);
    }
    public function rechercheOuvrier()
    {
        $ouvriers = Ouvrier::paginate(5);
        $links = $ouvriers->render();
        $types = TypeOuvrier::all();

        return view('recherche.ouvrier', compact('ouvriers', 'types', 'links'));
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
            $resultat = $resultat->diplome();
        }

        $resultat = $resultat->paginate(5);

        $appends = [
            'nom' => $recherche->nom, 
            'prenom' => $recherche->prenom,
            'wilaya' => $recherche->wilaya,
            'region' => $recherche->region,
            'reputationMin' => $recherche->reputationMin,
            'reputationMax' => $recherche->reputationMax,
            'prixApproxMin' => $recherche->prixApproxMin,
            'prixApproxMax' => $recherche->prixApproxMax,
            'experienceMin' => $recherche->experienceMin,
            'experienceMax' => $recherche->experienceMax,
            'type' => $recherche->type,
            'diplome' => $recherche->diplome          
        ];

        $links = $resultat->appends($appends)->render();

        return view('recherche.ouvrier', ['ouvriers' => $resultat, 'types' => TypeOuvrier::all(), 'links' => $links]);

    }
    public function rechercheEntrepreneur()
    {
        $entrepreneurs = Entrepreneur::paginate(5);
        $links = $entrepreneurs->render();
        return view('recherche.entrepreneur', compact('entrepreneurs', 'links'));
    }
    public function rechercheEntrepreneurFiltre(Request $recherche)
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
            $resultat = $resultat->dateDispoMin($recherche->dispoMin);
        }
        if($recherche->dispoMax != null)
        {
            $resultat = $resultat->dateDispoMax($recherche->dispoMax);
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

        //dd($resultat->toSql());
        $resultat = $resultat->paginate(5);



        $appends = [
            'nom' => $recherche->nom, 
            'prenom' => $recherche->prenom,
            'wilaya' => $recherche->wilaya,
            'region' => $recherche->region,
            'reputationMin' => $recherche->reputationMin,
            'reputationMax' => $recherche->reputationMax,
            'experienceMin' => $recherche->experienceMin,
            'experienceMax' => $recherche->experienceMax,
            'dateDispoMin' => $recherche->dateDispoMin,
            'dateDispoMax' => $recherche->dateDispoMax       
        ];

        $links = $resultat->appends($appends)->render();
        return view('recherche.entrepreneur', ['entrepreneurs' => $resultat, 'types' => TypeOuvrier::all(), 'links' => $links]);
    }
}
