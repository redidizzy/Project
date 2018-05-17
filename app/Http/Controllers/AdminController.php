<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\TypeOuvrier;
use App\TypeProjet;

class AdminController extends Controller
{
	
	
    public function index()
	{
		$utilisateurs=User::where('is_admin', 0)->where('is_banned', false)->where('id', '!=', Auth::user()->id)->get();
		$typesOuvrier = TypeOuvrier::all();
		$typesProjet = TypeProjet::all();
		$utilisateursSignale = User::whereHas('signalements')->get();
		$utilisateursBannis = User::where('is_banned', true)->get();
		return view ('admin.index', compact('utilisateurs', 'typesOuvrier', 'typesProjet', 'utilisateursSignale', 'utilisateursBannis'));
	}
	public function creerTypeProjet(Request $request)
	{
		TypeProjet::create([
			'designation' => $request->designation,
			'description' => $request->description
		]);
		return redirect()->route('admin.index');
	}
	public function creerTypeOuvrier(Request $request)
	{
		TypeOuvrier::create([
			'designation' => $request->designation,
			'description' => $request->description
		]);
		return redirect()->route('admin.index');
	}
	public function makeAdmin($user_id)
	{
		$user = User::find($user_id);
		$user->is_admin = true;
		$user->save();

		return redirect()->route('admin.index');
	}
	public function ban($user_id)
	{
		$user= User::find($user_id);
		$user->is_banned = true;
		$user->save();

		return redirect()->route('admin.index');
		
	}
	public function unban($user_id)
	{
		$user= User::find($user_id);
		$user->is_banned = false;
		$user->save();

		return redirect()->route('admin.index');
		
	}
	
}
