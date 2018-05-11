<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
    //
}
