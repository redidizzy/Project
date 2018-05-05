<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Client;
use App\Projet;
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

				//pour ce faire, l'utilisateur devra logiquement rechercher le nom ou prenom des clients qui ont cree le projet

				$clients = User::where('userable_type', '=', 'Client')->where('nom', 'like', $recherche)->orWhere('prenom', 'like', $recherche)->get();//a verifier
				//pour chaque client, on aura besoin de la liste de ces projets
				$projets = [];
				foreach($clients as $client)
				{
					
						if($client->userable->projets != null)
						{
							foreach($client->userable->projets as $projet)
								$projets[] = $projet;
						}
				}
				$resultats = $projets;
				return view('recherche.rapide', compact('resultats'));
				break;
			case 'Ouvrier':
				//dans le cas d'un ouvrier, la recherche rapide concernera aussi les projets
				$clients = User::where('userable_type', '=', 'Client')->where('nom', 'like', $recherche)->orWhere('prenom', 'like', $recherche)->get();//a verifier
				//pour chaque client, on aura besoin de la liste de ces projets
				$projets = [];
				foreach($clients as $client)
				{
					
						if($client->userable->projets != null)
						{
							foreach($client->userable->projets as $projet)
								$projets[] = $projet;
						}
				}
				$resultats = $projets;
				return view('recherche.rapide', compact('resultats'));
				break;
			case 'Client':
				//dans le cas d'un client, la recherche rapide concernera les entrepreneurs
				$entrepreneurs = User::where('userable_type', '=', 'Entrepreneur')->where('nom', 'like', $recherche)->orWhere('prenom', 'like', $recherche)->get();
				return view('recherche.rapide.entrepreneur', compact('entrepreneurs'));
		}
		
	}
    //

}
