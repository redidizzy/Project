<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OffreEmploi extends Model
{
	protected $guarded = [];
    public function entrepreneur()
	{
		return $this->belongsTo('App\Entrepreneur');
	}
	//pour recuperer les ouvriers postulants a une offre d'emploi
	public function ouvriers()
	{
		return $this->belongsToMany('App\Ouvrier')->using('App\OffreOuvrier');
	}
	
	public function type()
	{
		return $this->belongsTo('App\TypeOuvrier', 'type_id');
	}
	
	
}
