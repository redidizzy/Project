<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Entrepreneur extends Model
{
	protected $guarded = [];
	public function user()
	{
		return $this->morphOne('App\User', 'userable');
	}

	public function attestations()
	{
		return $this->hasMany('App\AttestationEntrepreneur');
	}

	
	// public function offres()
	// {
	// 	return $this->hasMany('App\OffreEmploi');
	// }
    

}
