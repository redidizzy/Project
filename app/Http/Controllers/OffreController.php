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
        $this->middleware('isBanned');
		$this->middleware('auth');
		$this->middleware('typeUser:Ouvrier,Entrepreneur',['only'=>['offrePourOuvrier','addPostulant']]);
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
		/*$offres = OffreEmploi::find($id);
        $postulants = $offres->ouvriers->withPivot();
		
		return view('offre.index');*/
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
		
		$offre->type_id = TypeOuvrier::where('designation', '=', $request->type)->first()->designation;
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
	public function addPostulant($id_offre,$id_postulant)
	{
		
		
		$offre = OffreEmploi::find($id_offre);
		$offre->ouvriers()->attach($id_postulant);
		return redirect()->route('offres.offrePourOuvrier',Auth::user()->id);
	}

	public function afficherPostulants($id)
	
	{
		
		$offre = OffreEmploi::find($id);
		$postulants = $offre->ouvriers;
		return view('postulants.index',compact('offre','postulants'));
	}
	
	public function offrePourOuvrier($id)
    {
        $user= User::find($id);
		
		
		$typeUser = $user->userable->fonction;
		
		$offres= OffreEmploi::where('type_id', '=',$typeUser)->get();
		
		return view('offres.offrePourOuvrier',compact('offres'));
		
    }
	
}
