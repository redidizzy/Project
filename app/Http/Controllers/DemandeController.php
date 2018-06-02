<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Repositories\DemandeRepository;
use App\Http\Repositories\UserRepository;

class DemandeController extends Controller
{
    protected $demandeRepository, $userRepository;
	public function __construct(DemandeRepository $demandeRepository, UserRepository $userRepository)
	{
        $this->demandeRepository = $demandeRepository; $this->userRepository = $userRepository;
		$this->middleware('auth');
        $this->middleware('isBanned');
        $this->middleware('typeUser:Ouvrier', ['only' => ['create', 'store', 'edit', 'update', 'destroy']]);
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
        if($user->userable_type != 'Ouvrier')
             return view('errors.error')->with(['msg' => 'L\'Utilisateur n\'est pas un ouvrier et ne peut donc pas avoir de demandes d\'emploi', 'titre' => 'Erreur']);

		$demandes= $this->demandeRepository->getDemandesOuvrier($user->userable);
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
        $utilisateur_id = $this->demandeRepository->creerDemande($request);
        return redirect()->route('demandes.index', $utilisateur_id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $demande= $this->demandeRepository->demandeNumero($id);
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
        $utilisateur_id = $this->demandeRepository->changerDemande($request, $id);
		return redirect()->route('demandes.index', $utilisateur_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $utilisateur_id = $this->demandeRepository->supprimerDemande($id);       
        return redirect()->route('demandes.index', $utilisateur_id); 
    }
	
	public function demandePourEntreClient()
	{
		$demandes= $this->demandeRepository->toutesLesDemandes();
		
		return view('demandes.demandePourEntreClient',compact('demandes'));
	}
}
