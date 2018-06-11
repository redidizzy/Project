<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Repositories\UserRepository;
use App\Http\Repositories\ProjetRepository;

class AdminController extends Controller
{
	protected $userRepository, $projetRepository;
	public function __construct(UserRepository $userRepository, ProjetRepository $projetRepository)
	{
		$this->userRepository = $userRepository;
		$this->projetRepository = $projetRepository;
		$this->middleware('isAdmin');
	}
	
    public function index()
	{
		$utilisateurs= $this->userRepository->utilisateursPourAdmin();
		$typesOuvrier = $this->userRepository->toutLesTypesOuvrier();
		$typesProjet = $this->projetRepository->toutLesTypes();
		$utilisateursSignale = $this->userRepository->utilisateursSignale();
		$utilisateursBannis = $this->userRepository->utilisateursBannis();
		return view ('admin.index', compact('utilisateurs', 'typesOuvrier', 'typesProjet', 'utilisateursSignale', 'utilisateursBannis'));
	}
	public function creerTypeProjet(Request $request)
	{
		$this->projetRepository->creerTypeProjet($request);
		return redirect()->route('admin.index');
	}
	public function creerTypeOuvrier(Request $request)
	{
		$this->userRepository->creerTypeOuvrier($request);
		return redirect()->route('admin.index');
	}
	public function makeAdmin($user_id)
	{
		$this->userRepository->rendreAdmin($user_id);

		return redirect()->route('admin.index');
	}
	public function ban($user_id)
	{
		$this->userRepository->bannir($user_id);
		return redirect()->route('admin.index');	
	}
	public function unban($user_id)
	{
		$this->userRepository->debannir($user_id);
		return redirect()->route('admin.index');
		
	}
	public function getSignalements($id)
	{
		$signalement = $this->userRepository->getSignalement($id);
		return $signalement;
	}
	
}
