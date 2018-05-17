<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TypeOuvrier extends Model
{
	protected $primaryKey = "designation";
	public $incrementing = false;
	protected $guarded = [];
	public function ouvriers()
	{
		return $this->hasMany('App\Ouvrier');
	}
    
	public function offres()
	{
		return $this->hasMany('App\OffreEmploi');
	}
}
