<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
	protected $guarded = [];
	public function user()
	{
		return $this->morphOne('App\User', 'userable');
	}
	public function projets()
	{
		return $this->hasMany('App\Projet');
	}
    //
}
