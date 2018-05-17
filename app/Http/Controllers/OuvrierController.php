<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OuvrierController extends Controller
{
    public function __construct()
	{
		$this->middleware('typeUser:Entrepreneur');
		$this->middleware('typeUser:Client');
	}
	/*public function postuler($offre_id)
	{
		$utilisateur = Auth::user()->userable->id;
		$utilisateur->offres->attach($offre_id);
	}*/
}
