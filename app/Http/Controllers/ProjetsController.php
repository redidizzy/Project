<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Projet;
use App\TypeProjet;
use App\Client;
use App\User;

class ProjetsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
        //TODO : ajout de middleware de verification : l'utilisateur est un client
    }
    public function index($id)
    {
        $projets = User::find($id)->userable->projets;
        $user = User::find($id);

        return view('projets.index', compact('projets', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('projets.create',['types' => TypeProjet::all()]) ;
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
       
        Projet::create([
            'type_id' => TypeProjet::where('designation', '=', $request->type)->first()->id,
            'client_id' => $utilisateur,
            'description' => $request->description,
            'wilaya' => $request->wilaya,
            'region' => $request->region,
            'adresse' => $request->adresse,
            'superficie' => $request->superficie,
            'budget' => $request->budget,
            'delai' => $request->delai,
            'necessiteEntrepreneur' => isset($request->necessiteEntrepreneur)
        ]); 

        return redirect()->route('projets.index', Auth::user()->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //je ne pense pas qu'on en aura besoin
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $projet = Projet::find($id);
        $types = TypeProjet::all();
        return view('projets.edit', compact('projet', 'types'));
        
    }

    /**
     * Update the specified resource in storage.
 
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $projet = Projet::find($id);

        $projet->type_id = TypeProjet::where('designation', '=', $request->type)->first()->id;
        $projet->description = $request->description;
        $projet->wilaya = $request->wilaya;
        $projet->region = $request->region;
        $projet->superficie = $request->superficie;
        $projet->budget = $request->budget;
        $projet->delai = $request->delai;
        $projet->necessiteEntrepreneur = isset($request->necessiteEntrepreneur);

        $projet->save();

        return redirect()->route('projets.index', Auth::user()->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Projet::find($id)->delete();
        return redirect()->route('projets.index', Auth::user()->id);   
    }
}
