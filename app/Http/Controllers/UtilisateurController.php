<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;

class UtilisateurController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}
	public function show($user_id)
	{
		$user = User::find($user_id);
		return view('utilisateur.profil', compact('user'));
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
}
