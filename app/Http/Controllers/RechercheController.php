<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Repositories\UserRepository;
use App\Http\Repositories\ProjetRepository;
use Illuminate\Database\Eloquent\Collection;

class RechercheController extends Controller
{
    protected $userRepository, $projetRepository;
	public function __construct(UserRepository $userRepository, ProjetRepository $projetRepository)
	{
        $this->userRepository = $userRepository;
        $this->projetRepository = $projetRepository;
		$this->middleware('auth');
        $this->middleware('isBanned');
        $this->middleware('typeUser:Entrepreneur,Ouvrier', ['only' => ['rechercheDeProjet', 'rechercheDeProjetFiltre']]);
        $this->middleware('typeUser:Entrepreneur,Client', ['only' => ['rechercheOuvrier', 'rechercheOuvrierFiltre']]);
        $this->middleware('typeUser:Ouvrier,Client', ['only' => ['rechercheEntrepreneur', 'rechercheEntrepreneurFiltre']]);
	}
	//le code commence vraiment a devenir illisible, envisager de commencer a faire des repository et a simplifier le code
	public function rapide(Request $researchRequest)
	{
		$recherche = $researchRequest->recherche;
		$resultats; //le resultat sera stocke ici
		//les recherches rapides varieront selon le type de l'utilisateur connecte
		switch($this->userRepository->typeUtilisateurConnecte())
		{
			case 'Entrepreneur':
				$resultat = $this->projetRepository->rechercherProjetRapide($recherche);
                return view('recherche.rapide', $resultat);
				break;

			case 'Ouvrier':
				//dans le cas d'un ouvrier, la recherche rapide concernera aussi les projets
				$resultat = $this->projetRepository->rechercherProjetRapide($recherche);
                return view('recherche.rapide', $resultat);
				break;
			case 'Client':
				//dans le cas d'un client, la recherche rapide concernera les entrepreneurs
				$resultat = $this->userRepository->rechercheRapide($recherche);
				return view('recherche.rapide.entrepreneur', $resultat);
		}
		
	}
    public function rechercheDeProjet()
    {
    	$resultat = $this->projetRepository->rechercherProjet();
    	return view('recherche.projet', $resultat);
    }
    public function rechercheDeProjetFiltre(Request $recherche)
    {
        $resultat = $this->projetRepository->rechercherProjet($recherche);
    	
    	return view('recherche.projet', $resultat);
    }
    public function rechercheOuvrier()
    {
        $resultat = $this->userRepository->rechercheOuvrier();
        return view('recherche.ouvrier', $resultat);
    }
    public function rechercheOuvrierFiltre(Request $recherche)
    {
        $resultat = $this->userRepository->rechercheOuvrier($recherche);
        return view('recherche.ouvrier', $resultat);

    }
    public function rechercheEntrepreneur()
    {
        $resultat = $this->userRepository->rechercheEntrepreneur();
        return view('recherche.entrepreneur', $resultat);
    }
    public function rechercheEntrepreneurFiltre(Request $recherche)
    {
        $resultat = $this->userRepository->rechercheEntrepreneur($recherche);
        return view('recherche.entrepreneur', $resultat);
    }
}
