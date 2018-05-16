<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Diplome;
use App\User;
use App\DemandeEmploi;
use App\TypeOuvrier;
use App\OffreEmploi;

class Ouvrier extends Model
{
	protected $guarded = [];
	public function user()
	{
		return $this->morphOne('App\User', 'userable');
	}
	
	
	public function diplomes()
	{
		return $this->hasMany('App\Diplome');
	}
	
	
	public function type()
	{
		return $this->hasOne('App\TypeOuvrier');
	}
	
	
	public function demandes()
	{
		return $this->hasMany('App\DemandeEmploi');
	}
    
	//pour recuperer les offres d'emploi en relation avec un ouvrier 
	public function offres()
	{
		return $this->belongsToMany('App\OffreEpmloi')->using('App\OffreOuvrier');
	}
	
	
	
}
