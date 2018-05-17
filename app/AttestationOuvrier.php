<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AttestationOuvrier extends Model
{
	protected $guarded = [];

	public function ouvrier()
	{
		return $this->belongsTo('App\Ouvrier');
	}
    //
}
