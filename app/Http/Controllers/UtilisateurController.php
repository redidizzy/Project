<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

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
    //
}
