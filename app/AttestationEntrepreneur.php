<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AttestationEntrepreneur extends Model
{
	protected $guarded = [];
	public function entrepreneur()
	{
		return $this->belongsTo('App\Entrepreneur', 'entrepreneur_id');
	}
    //
}
