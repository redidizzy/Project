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

    //
}
