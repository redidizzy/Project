<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Http\Repositories\UserRepository;

class UtilisateurController extends Controller
{
    protected $userRepository;
	public function __construct(UserRepository $userRepository)
	{
		$this->middleware('auth');
        $this->middleware('isBanned');
        $this->userRepository = $userRepository;
        $this->middleware('typeUser:Entrepreneur', ['only' => ['changeEntrepreneurInfo', 'changeEntrepreneurDispo']]);
	}
	public function show($user_id)
	{
		$user = $this->userRepository->utilisateurNumero($user_id);
        $types = $this->userRepository->toutLesTypesOuvrier();
        

        if(!$user)
        {
            return view('errors.error')->with(['msg' => 'L\'Utilisateur que vous souhaitez consulter n\'existe pas !', 'titre' => 'Utilisateur Non-Existant']);
        }        
        $ratings = $this->userRepository->getReputation($user);
        $noteUtilisateur = $this->userRepository->getNoteDeUtilisateurConnecte($user);
        $note = $this->userRepository->getNoteFinal($user);  

		return view('utilisateur.profil', compact('user', 'types', 'note', 'noteUtilisateur', 'ratings'));
	}
	
	// public function showAll($user_id)
	// {
	// 	$user = $this->userRepository->utilisateurNumero($user_id);
	// 	$utilisateurs = User::all();
	// 	return view('admin.index', compact('utilisateurs','user'));
	// }
	
	public function edit()
	{
		$user = $this->userRepository->utilisateurConnecte();
		return view('utilisateur.edit', compact('user'));
	}
    public function saveChange(Request $request)
    {
        $url = null;
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
		
		
        $utilisateur_id = $this->userRepository->changerInfos($request, $url);
    	
    	return redirect(route('utilisateur.profil', $utilisateur_id));

    }


    public function changeEntrepreneurInfo(Request $request)
    {
        
        $utilisateur_id = $this->userRepository->changerInfosEntrepreneur($request);
        return redirect()->route('utilisateur.profil', $utilisateur_id);
    }
    public function changeEntrepreneurDispo(Request $request)
    {
        $utilisateur_id = $this->userRepository->changerEntrepreneurDispo($request);
        return redirect()->route('utilisateur.profil', $utilisateur_id);
    }
    public function changePassword(Request $request)
    {
        $utilisateur_id = $this->userRepository->changerPass($request);
        return redirect()->route('utilisateur.profil', $utilisateur_id);
    }
    public function addAttestation(Request $request)
    {
        $utilisateur_id = $this->userRepository->utilisateurConnecte()->id;
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
            $utilisateur_id = $this->userRepository->ajoutAttestation($request, $url);
        }
        return redirect()->route('utilisateur.profil', $utilisateur_id);
    }
    public function addDiplome(Request $request)
    {
        $utilisateur_id = $this->userRepository->utilisateurConnecte()->id;
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
            $utilisateur_id = $this->userRepository->ajoutDiplome($request, $url);
        }
        return redirect()->route('utilisateur.profil', $utilisateur_id);
    }
    public function changerProfession(Request $request)
    {
       $utilisateur_id = $this->userRepository->changerProfession($request);

        return redirect()->route('utilisateur.profil', $utilisateur_id);
    }
    public function changerPrix(Request $request)
    {
        $utilisateur_id = $this->userRepository->changerPrix($request);

        return redirect()->route('utilisateur.profil', $utilisateur_id);
    }
    public function signaler(Request $request, $user_id)
    {
        $utilisateur_id = $this->userRepository->signaler($request, $user_id);

        return redirect()->route('utilisateur.profil', $utilisateur_id);
    }
    public function rate($id, Request $request)
    {
       $utilisateur = $this->userRepository->noter($id, $request);
        return $this->userRepository->getNoteFinal($utilisateur);     
    }   
}
