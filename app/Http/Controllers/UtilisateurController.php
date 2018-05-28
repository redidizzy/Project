<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\AttestationEntrepreneur;
use App\AttestationOuvrier;
use App\Diplome;
use App\TypeOuvrier;
use App\Signalement;
use App\RatingOuvrier;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UtilisateurController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
        $this->middleware('isBanned');
	}
	public function show($user_id)
	{
		$user = User::find($user_id);
        $types = TypeOuvrier::all();
        $note = 0;
        $noteUtilisateur = 0;
        if($user->userable_type == "Entrepreneur" or $user->userable_type == "Ouvrier")
        {
            if($user->userable->ratings->first())
            {
                $note = $user->userable->finalRating();
                $noteUtilisateur = $user->userable->ratings->where("user_id", Auth::user()->id)->first()->rating;
            }
        }
		return view('utilisateur.profil', compact('user', 'types', 'note', 'noteUtilisateur'));
	}
	
	public function showAll($user_id)
	{
		$user = User::find($user_id);
		$utilisateurs = User::all();
		return view('admin.index', compact('utilisateurs','user'));
	}
	
	public function edit()
	{
		$user = Auth::user();
		return view('utilisateur.edit', compact('user'));
	}
    public function saveChange(Request $request)
    {
    	$user = Auth::user();
        
    	if($request->hasFile('photo'))
    	{
    		$img = $request->file('photo');

    		if($img->isValid())
    		{
    			$path = config('images.path');
    			$extension = $img->getClientOriginalExtension();
    			do{
    				$name = str_random(10).'.'.$extension;
    			}while(file_exists($path.'/'.$name));
    			if($img->move($path, $name))
				{
					$url = $path.'/'.$name;
				}
    		}

    	}
    	$user->nom = $request->nom;
    	$user->prenom = $request->prenom;
    	$user->dateNaiss = $request->dateNaiss;
    	$user->wilaya = $request->wilaya;
    	$user->region = $request->region;
    	$user->photoProfil = $url;
    	$user->numTel = $request->numTel;

    	$user->save();

    	return redirect(route('utilisateur.profil', $user->id));

    }
    public function changeEntrepreneurInfo(Request $request)
    {
        $user = Auth::user();

        $user->userable->nom_entreprise = $request->nom_entreprise;
        $user->userable->description_entreprise = $request->description_entreprise;
        $user->userable->materiel = $request->materiel;

        $user->userable->save();

        return redirect()->route('utilisateur.profil', $user->id);
    }
    public function changeEntrepreneurDispo(Request $request)
    {
        $user = Auth::user();
        $user->userable->dateDebutDispo = $request->dateDebutDispo;
        $user->userable->dateFinDispo = $request->dateFinDispo;

        $user->userable->save();

        return redirect()->route('utilisateur.profil', $user->id);
    }
    public function changePassword(Request $request)
    {
        $user = Auth::user();

        if(Hash::check($request->oldPassword, $user->password) and $request->newPassword == $request->rnewPassword)
        {
            $user->password = bcrypt($request->newPassword);
            $user->save();
        }
        return redirect()->route('utilisateur.profil', $user->id);
    }
    public function addAttestation(Request $request)
    {
        $user = Auth::user();

        $file = $request->file('attestation');
        if($file)
        {
            $path = config('images.path');
            $extension = $file->getClientOriginalExtension();

            do{
                $file_name = str_random(10).'.'.$extension;
            }while(file_exists($path.'/'.$file_name));

            if($file->move($path, $file_name))
            {
                $url=$path.'/'.$file_name;
            }
            if(Auth::user()->userable_type == "Entrepreneur")
                $attestation = new AttestationEntrepreneur();
            else 
                $attestation = new AttestationOuvrier();
            $attestation->photo_url= $url;
            if(Auth::user()->userable_type == "Entrepreneur")
                $attestation->entrepreneur_id = $user->userable->id;
            else
                $attestation->ouvrier_id = $user->userable->id;
            $attestation->save();
        }
        return redirect()->route('utilisateur.profil', $user->id);
    }
    public function addDiplome(Request $request)
    {
        $user = Auth::user();

        $file = $request->file('diplome');
        if($file)
        {
            $path = config('images.path');
            $extension = $file->getClientOriginalExtension();

            do{
                $file_name = str_random(10).'.'.$extension;
            }while(file_exists($path.'/'.$file_name));

            if($file->move($path, $file_name))
            {
                $url=$path.'/'.$file_name;
            }
            $diplome = new Diplome;
            $diplome->titre = $request->titre;
            $diplome->photoDiplome= $url;
            $diplome->ouvrier_id = $user->userable->id;
            $diplome->save();
        }
        return redirect()->route('utilisateur.profil', $user->id);
    }
    public function changerProfession(Request $request)
    {
        $user = Auth::user();
        $ouvrier = $user->userable;
        $ouvrier->fonction = $request->profession;
        $ouvrier->save();

        return redirect()->route('utilisateur.profil', $user->id);
    }
    public function changerPrix(Request $request)
    {
        $user= Auth::user();
        $ouvrier = $user->userable;
        $ouvrier->prixApprox = $request->prix;
        $ouvrier->save();

        return redirect()->route('utilisateur.profil', $user->id);
    }
    public function signaler(Request $request, $user_id)
    {
        $user = User::find($user_id);

        Signalement::create([
            'user_id' => $user->id,
            'motif' => $request->motif
        ]);

        return redirect()->route('utilisateur.profil', $user->id);
    }
    public function rate($id, Request $request)
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
                $rating->save();
            }
            else
            {
                RatingOuvrier::create([
                    'ouvrier_id' => $user->userable->id,
                    'user_id' => Auth::user()->id,
                    'rating' => $request->newValue
                ]);
            }
        }
        return $user->userable->finalRating();     
    }   
}
