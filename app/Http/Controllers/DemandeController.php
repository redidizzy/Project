<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Ouvrier;
use App\TypeOuvrier;
use App\Client;
use App\User;
use Auth;
use App\DemandeEmploi;

class DemandeController extends Controller
{
	public function __construct()
	{
		return $this->middleware('auth');
		return $this->middleware('typeUser:Client');
		return $this->middleware('typeUser:Ouvrier',['except'=>'index']);
	}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        //
		$demandes= User::find($id)->userable->demandes;
		$user= User::find($id);
		return view('demandes.index',compact('demandes','user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
		return view('demandes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $utilisateur = Auth::user()->userable->id;
       
        DemandeEmploi::create([
            
            'ouvrier_id' => $utilisateur,
            'contenu' => $request->contenu
        ]); 

        return redirect()->route('demandes.index', Auth::user()->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $demande=DemandeEmploi::find($id);
		return view('demandes.edit',compact('demande'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $demande= DemandeEmploi::find($id);
		$demande->contenu = $request->contenu;
		
		$demande->save();
		return redirect()->route('demandes.index', Auth::user()->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       DemandeEmploi::find($id)->delete();
        return redirect()->route('demandes.index', Auth::user()->id); 
    }
	
	public function demandePourEntreClient()
	{
		$demandes= DemandeEmploi::all();
		
		return view('demandes.demandePourEntreClient',compact('demandes'));
	}
}
