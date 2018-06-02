<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Http\Repositories\UserRepository;
use App\Http\Repositories\OffreRepository;

class OffreController extends Controller
{
	protected $userRepository;
    protected $offreRepository;
	public function __construct(UserRepository $userRepository, OffreRepository $offreRepository)
	{
        $this->middleware('isBanned');
		$this->middleware('auth');
		//$this->middleware('typeUser:Ouvrier,Entrepreneur',['only'=>['offrePourOuvrier']]);
        $this->middleware('typeUser:Ouvrier', ['only' => ['addPostulant']]);
        $this->middleware('typeUser:Entrepreneur', ['only' =>['create', 'store', 'update', 'edit', 'destroy', 'afficherPostulants']]);
        $this->userRepository = $userRepository;
        $this->offreRepository = $offreRepository;
	}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
		$user= $this->userRepository->utilisateurNumero($id);
        if(!$user)
            return view('errors.error')->with(['msg' => 'L\'Utilisateur que vous souhaitez consulter n\'existe pas !', 'titre' => 'Utilisateur Non-Existant']);
        if($user->userable_type != 'Entrepreneur')
             return view('errors.error')->with(['msg' => 'L\'Utilisateur n\'est pas un Entrepreneur et ne peut donc pas avoir d\'offres d\'emploi', 'titre' => 'Erreur']);

        $offres= $this->offreRepository->getOffresEntrepreneur($user->userable);
		return view('offres.index',compact('offres','user'));
		
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		$types = $this->offreRepository->toutLesTypesOuvriers();
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
       $utilisateur_id = $this->offreRepository->creerOffre($request);
	   return redirect()->route('offres.index', $utilisateur_id);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
		$offre= $this->offreRepository->getOffre($id);
		$types = $this->offreRepository->toutLesTypesOuvriers();
		
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
        $utilisateur_id = $this->offreRepository->changerOffre($request, $id);
		return redirect()->route('offres.index', $utilisateur_id);	
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $utilisateur_id = $this->offreRepository->supprimerOffre($id);
		return redirect()->route('offres.index', $utilisateur_id);
		
    }
	public function addPostulant($id_offre)
	{
		
		
		$this->offreRepository->postuler($id_offre);
		return redirect()->back();
	}

    public function afficherPostulant($id)
    {
        
        $offre = $this->offreRepository->getOffre($id);
       
        $postulants = $this->offreRepository->getPostulants($offre);
        return view('postulants.index',compact('offre','postulants'));
    }
	//a voir
	public function offrePourOuvrier()
    {
        $offres = $this->offreRepository->getOffresPourOuvrier();
		
		return view('offres.offrePourOuvrier',compact('offres'));
		
    }
	
}
