<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Projet extends Model
{
	protected $guarded = ['created_at', 'modified_at'];
	public function client()
	{
		return $this->belongsTo('App\Client');
	}
    //
}
