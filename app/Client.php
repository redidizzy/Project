<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
	public function user()
	{
		return $this->morphOne('App\User', 'userable');
	}
    //
}
