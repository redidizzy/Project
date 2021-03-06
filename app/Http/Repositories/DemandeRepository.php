<?php

namespace App\Http\Repositories;

use Illuminate\Support\Facades\Auth;

use App\DemandeEmploi;
use App\TypeOuvrier;
	

class DemandeRepository{
	public function getDemandesOuvrier($ouvrier)
	{
		$demandes = $ouvrier->demandes()->paginate(5);
		
		return [$demandes, $demandes->render()];
	}
	public function creerDemande($request)
	{
		$utilisateur = Auth::user()->userable->id;
       
        DemandeEmploi::create([
            
            'ouvrier_id' => $utilisateur,
            'contenu' => $request->contenu
        ]); 

        return Auth::user()->id;
	}
	public function demandeNumero($id)
	{
		return DemandeEmploi::find($id);	
	}
	public function changerDemande($request, $id)
	{
		$demande= DemandeEmploi::find($id);
		$demande->contenu = $request->contenu;
		$demande->save();

		return Auth::user()->id;
	}
	public function supprimerDemande($id)
	{
		DemandeEmploi::find($id)->delete();
		return Auth::user()->id;
	}
	public function toutesLesDemandes()
	{
		$demandes = DemandeEmploi::paginate(5);
		return ['demandes'=>$demandes, 'links'=>$demandes->render()];
	}
}