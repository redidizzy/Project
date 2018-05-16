<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Ouvrier;
use App\TypeOuvrier;
use App\Client;
use App\User;
use Auth;
use App\OffreEmploi;
class OffreController extends Controller
{
	
	public function __construct()
	{
		return $this->middleware('auth');
		return $this->middleware('typeUser:Ouvrier',['except'=>'index']);
		return $this->middleware('notEntrepreneur');
	}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
		
        $offres= User::find($id)->userable->offres;
		$user= User::find($id);
		return view('offres.index',compact('offres','user'));
		
    }
	
	
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		$types = TypeOuvrier::all();
        return view ('offres.create', compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $utilisateur=Auth::user()->userable->id;
	   OffreEmploi::create([
			'type_id' => TypeOuvrier::find($request->type)->designation,
			'entrepreneur_id' => $utilisateur,
			'contenu' => $request->contenu
		]);
	   
	   return redirect()->route('offres.index', Auth::user()->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
		$offres = OffreEmploi::find($id);
        $postulants = $offres->ouvriers->withPivot();
		
		return view('offre.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
		$offre=OffreEmploi::find($id);
		$types = TypeOuvrier::all();
		
        return view('offres.edit',compact('offre','types'));
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
		
        $offre=OffreEmploi::find($id);
		
		$offre->type = TypeOuvrier::where('designation', '=', $request->type)->first()->id;
		$offre->contenu = $request->contenu;
		
		$offre->save();
		return redirect()->route('offres.index',Auth::user()->id);
		
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        OffreEmploi::find($id)->delete();
		return redirect()->route('offres.index', Auth::user()->id);
		
    }
	public function addPostulant($id)
	{
		$utilisateur=Auth::user()->userable->id;
		$offre = OffreEmploi::find($id);
		$utilisateur->offre->attach($id);
		return redirect()->route('offres.index',Auth::user()->id);
	}
	
}
