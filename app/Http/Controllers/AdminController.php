<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
	
	
    public function index()
	{
		return view ('admin.index');
	}
	
	 public function showAll($id)
	{
		$user=User::find($id);
		$utilisateurs=User::all();
		
		return view ('admin.index',compact('utilisateurs','user'));
	}
	
	
}
