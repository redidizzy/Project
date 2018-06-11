<?php

namespace App\Http\Repositories;

use Illuminate\Support\Facades\Auth;

use App\User;
use App\TypeOuvrier;
use App\AttestationEntrepreneur;
use App\AttestationOuvrier;
use App\Diplome;
use App\Signalement;
use App\RatingOuvrier;
use App\RatingEntrepreneur;
use App\Ouvrier;
use App\Entrepreneur;
use Illuminate\Support\Facades\Hash;


class UserRepository{
	protected $user;

	public function __construct(User $user)
	{
		$this->user = $user;
	}

	public function utilisateurConnecte()
	{
		return Auth::user();
	}
	public function utilisateurNumero($n)
	{
		return $this->user->find($n);
	}
	public function toutLesTypesOuvrier()
	{
		return TypeOuvrier::all();
	}
	public function getReputation($user)
	{
		$ratings = collect();
		if($user->userable_type == "Entrepreneur" or $user->userable_type == "Ouvrier")
        {
            $ratings = $user->userable->ratings;
        }
        return $ratings;
	}
	public function getNoteDeUtilisateurConnecte($user)
	{
		$noteUtilisateur = 0;
		if($user->userable_type == "Entrepreneur" or $user->userable_type == "Ouvrier")
        	if($user->userable->ratings->where("user_id", Auth::user()->id)->first())
            	$noteUtilisateur = $user->userable->ratings->where("user_id", Auth::user()->id)->first()->rating;
        return $noteUtilisateur;
	}
	public function getNoteFinal($user)
	{
		$note= 0;
		 if($user->userable_type == "Entrepreneur" or $user->userable_type == "Ouvrier")
		 	if($user->userable->ratings->first())
                $note = $user->userable->finalRating();
        return $note;
	}
	public function changerInfos($request, $url)
	{
		$user = Auth::user();

		$user->nom = $request->nom;
    	$user->prenom = $request->prenom;
    	$user->dateNaiss = $request->dateNaiss;
    	$user->wilaya = $request->wilaya;
    	$user->region = $request->region;
		if($url)
			$user->photoProfil = $url;
    	$user->numTel = $request->numTel;

    	$user->save();

    	return $user->id;
	}
	public function changerInfosEntrepreneur($request)
	{
		$user = Auth::user();

        $user->userable->nom_entreprise = $request->nom_entreprise;
        $user->userable->description_entreprise = $request->description_entreprise;
        $user->userable->materiel = $request->materiel;

        $user->userable->save();

        return $user->id;
	}
	public function changerEntrepreneurDispo($request)
	{
		$user = Auth::user();
        $user->userable->dateDebutDispo = $request->dateDebutDispo;
        $user->userable->dateFinDispo = $request->dateFinDispo;

        $user->userable->save();

        return $user->id;
	}
	public function ajoutAttestation($request, $url)
	{
		$user = Auth::user();
		if($user->userable_type == "Entrepreneur")
            $attestation = new AttestationEntrepreneur();
        else 
            $attestation = new AttestationOuvrier();
        $attestation->photo_url= $url;
        if($user->userable_type == "Entrepreneur")
            $attestation->entrepreneur_id = $user->userable->id;
        else
            $attestation->ouvrier_id = $user->userable->id;
        $attestation->save();

        return $user->id;

	}
	public function ajoutDiplome($request, $url)
	{
		$user = Auth::user();
		$diplome = new Diplome;
        $diplome->titre = "diplome";
        $diplome->photoDiplome= $url;
        $diplome->ouvrier_id = $user->userable->id;
        $diplome->save();
        return $user->id;
	}
	public function changerProfession($request)
	{
		$user = Auth::user();
        $ouvrier = $user->userable;
        $ouvrier->fonction = $request->profession;
        $ouvrier->save();

        return $user->id;
	}
	public function changerPrix($request)
	{
		$user= Auth::user();
        $ouvrier = $user->userable;
        $ouvrier->prixApprox = $request->prix;
        $ouvrier->save();
        return $user->id;
	}
	public function signaler($request, $user_id)
	{
		$user = User::find($user_id);

        Signalement::create([
            'user_id' => $user->id,
            'motif' => $request->motif
        ]);

        return $user->id;
	}
	public function noter($id, $request)
	{
		$user = User::find($id);

        if($user->userable_type == "Ouvrier")
        {
            $rating = RatingOuvrier::where('ouvrier_id', $user->userable->id)
                        ->where('user_id', Auth::user()->id)
                        ->first();
            if($rating)
            {
                $rating->rating = $request->newValue;
                $rating->comment = $request->commentaire;
                $rating->save();
            }
            else
            {
                RatingOuvrier::create([
                    'ouvrier_id' => $user->userable->id,
                    'user_id' => Auth::user()->id,
                    'rating' => $request->newValue,
                    'comment' => $request->commentaire
                ]);
            }
        }
        else
        {
            $rating = RatingEntrepreneur::where('entrepreneur_id', $user->userable->id)
                        ->where('user_id', Auth::user()->id)
                        ->first();
            if($rating)
            {
                $rating->rating = $request->newValue;
                $rating->comment = $request->commentaire;
                $rating->save();
            }
            else
            {
                RatingEntrepreneur::create([
                    'entrepreneur_id' => $user->userable->id,
                    'user_id' => Auth::user()->id,
                    'rating' => $request->newValue,
                    'comment' => $request->commentaire
                ]);
            }
        }
        return $user;
	}
	public function changerPass($request)
	{
		$user = Auth::user();

        if(Hash::check($request->oldPassword, $user->password) and $request->newPassword == $request->rnewPassword)
        {
            $user->password = bcrypt($request->newPassword);
            $user->save();
        }

        return $user->id;
	}
    public function utilisateursPourAdmin()
    {
        return User::where('is_admin', 0)->where('is_banned', false)->where('id', '!=', Auth::user()->id)->get();
    }
    public function utilisateursSignale()
    {
        return User::whereHas('signalements')->get();
    }
    public function utilisateursBannis()
    {
        return User::where('is_banned', true)->get();
    }
    public function creerTypeOuvrier($request)
    {
        TypeOuvrier::create([
            'designation' => $request->designation,
            'description' => $request->description
        ]);
    }
    public function rendreAdmin($user_id)
    {
        $user = User::find($user_id);
        $user->is_admin = true;
        $user->save();
    }
    public function bannir($user_id)
    {
        $user= User::find($user_id);
        $user->is_banned = true;
        $user->save();
    }
    public function debannir($user_id)
    {
        $user= User::find($user_id);
        $user->is_banned = false;
        $user->save();
    }
    public function typeUtilisateurConnecte()
    {
        return Auth::user()->userable_type;
    }
    public function rechercheRapide($recherche)
    {
        $entrepreneurs = collect();

        $entrepreneurs = User::where('userable_type', 'Entrepreneur')->where(function($query) use ($recherche){
            $query->where('nom', $recherche)->orWhere('prenom', $recherche);
        })->paginate(5);
        $links = $entrepreneurs->appends(compact('recherche'))->render();

        return compact('entrepreneurs', 'links');
    }

    public function rechercheOuvrier($recherche = null)
    {
        if(!$recherche)
        {
            $ouvriers = Ouvrier::paginate(5);
            $links = $ouvriers->render();
            $types = TypeOuvrier::all();

            $return = compact('ouvriers', 'types', 'links');
        }
        else
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

            if($recherche->tri != null)
            {
                if($recherche->tri == 'reputation')
                {
                    if($recherche->asc == 1)
                        $resultat = $resultat->sortBy(function($item){
                            return  $item->finalRating();
                        });
                    else
                         $resultat = $resultat->sortByDesc(function($item){
                            return  $item->finalRating();
                        });

                }
                else if($recherche->tri == 'experience')
                {
                    if($recherche->asc==1)
                        $resultat = $resultat->sortBy(function($item){
                            return $item->attestations->count();
                        });
                    else
                        $resultat = $resultat->sortByDesc(function($item){
                            return $item->attestations->count();
                        });
                }
                else if($recherche->tri == 'nom')
                {
                     if($recherche->asc==1)
                        $resultat = $resultat->sortBy(function($item){
                            return $item->user->nom;
                        });
                    else
                        $resultat = $resultat->sortByDesc(function($item){
                            return $item->user->nom;
                        });
                }

                else if($recherche->tri == 'prenom')
                {

                    if($recherche->asc==1)
                        $resultat = $resultat->sortBy(function($item){
                            return strtoupper($item->user->prenom);
                        });
                    else
                        $resultat = $resultat->sortByDesc(function($item){
                            return strtoupper($item->user->prenom);
                        });
                }
                else if($recherche->tri == 'nbDiplome')
                {
                     if($recherche->asc==1)
                        $resultat = $resultat->sortBy(function($item){
                            return $item->diplomes->count();
                        });
                    else
                        $resultat = $resultat->sortByDesc(function($item){
                            return $item->diplomes->count();
                        });
                }
                else
                {
                    if($recherche->asc==1)
                        $resultat = $resultat->sortBy($recherche->tri);
                    else 
                        $resultat = $resultat->sortByDesc($recherche->tri);
                }
            }
            $return = ['ouvriers' => $resultat, 'types' => TypeOuvrier::all(), 'links' => $links];
        }
        return $return;
    }
    public function rechercheEntrepreneur($recherche = null)
    {
        if(!$recherche)
        {
            $entrepreneurs = Entrepreneur::paginate(5);
            $links = $entrepreneurs->render();
            $return =  compact('entrepreneurs', 'links');

        }
        else
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

            //le tri



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
             if($recherche->tri != null)
            {
                if($recherche->tri == 'reputation')
                {
                    if($recherche->asc == 1)
                        $resultat = $resultat->sortBy(function($item){
                            return  $item->ratings->avg('rating');
                        });
                    else
                         $resultat = $resultat->sortByDesc(function($item){
                            return  $item->ratings->avg('rating');
                        });

                }
                else if($recherche->tri == 'experience')
                {
                    if($recherche->asc==1)
                        $resultat = $resultat->sortBy(function($item){
                            return $item->attestations->count();
                        });
                    else
                        $resultat = $resultat->sortByDesc(function($item){
                            return $item->attestations->count();
                        });
                }
                else if($recherche->tri == 'nom')
                {
                     if($recherche->asc==1)
                        $resultat = $resultat->sortBy(function($item){
                            return $item->user->nom;
                        });
                    else
                        $resultat = $resultat->sortByDesc(function($item){
                            return $item->user->nom;
                        });
                }

                else if($recherche->tri == 'prenom')
                {

                    if($recherche->asc==1)
                        $resultat = $resultat->sortBy(function($item){
                            return strtoupper($item->user->prenom);
                        });
                    else
                        $resultat = $resultat->sortByDesc(function($item){
                            return strtoupper($item->user->prenom);
                        });
                }
                else
                {
                    if($recherche->asc==1)
                        $resultat = $resultat->sortBy($recherche->tri);
                    else
                       $resultat = $resultat->sortByDesc($recherche->tri);
                }


            }
            $return = ['entrepreneurs' => $resultat, 'types' => TypeOuvrier::all(), 'links' => $links];
        }

        return $return;
    }
	public function getSignalement($id)
	{
		return User::find($id)->signalements;
	}
}