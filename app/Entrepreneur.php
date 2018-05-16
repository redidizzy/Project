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
	public static function dispo()
	{
		return self::where('disponibilite', 1)->get();
	}
	
	public function offres()
	{
		return $this->hasMany('App\OffreEmploi');
	}
    
}
