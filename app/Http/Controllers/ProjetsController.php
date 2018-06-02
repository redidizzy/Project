<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\User;

use App\Http\Repositories\ProjetRepository;
use App\Http\Repositories\UserRepository;

class ProjetsController extends Controller
{
    protected $projetRepository, $userRepository;

    public function __construct(ProjetRepository $projetRepository, UserRepository $userRepository)
    {
        $this->middleware('auth');
		$this->middleware('typeUser:Client', ['only' => ['create', 'store', 'update', 'edit', 'destroy']]);
        $this->middleware('isBanned');
        $this->projetRepository = $projetRepository;
        $this->userRepository = $userRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $user = $this->userRepository->utilisateurNumero($id);

        if(!$user)
            return view('errors.error')->with(['msg' => 'L\'Utilisateur que vous souhaitez consulter n\'existe pas !', 'titre' => 'Utilisateur Non-Existant']);
        if($user->userable_type != 'Client')
             return view('errors.error')->with(['msg' => 'L\'Utilisateur n\'est pas un client et ne peut donc pas avoir de projets', 'titre' => 'Erreur']);

        $projets = $this->projetRepository->getProjetDuClient($user->userable);

        //dd($projets->get(1)->type);
        return view('projets.index', compact('projets', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('projets.create',['types' => $this->projetRepository->toutLesTypes()]) ;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $utilisateur_id = $this->projetRepository->creerProjet($request);
        return redirect()->route('projets.index', $utilisateur_id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $projet = $this->projetRepository->projetNumero($id);
        $types = $this->projetRepository->toutLesTypes();
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
        $utilisateur_id = $this->projetRepository->changerProjet($request, $id);
        return redirect()->route('projets.index', $utilisateur_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $utilisateur_id = $this->projetRepository->supprimerProjet($id);
        return redirect()->route('projets.index', $utilisateur_id);   
    }
}
