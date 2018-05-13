<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TypeOuvrier extends Model
{
	protected $primaryKey = "designation";
	public $incrementing = false;
	public function ouvriers()
	{
		return $this->hasMany('App\Ouvrier');
	}
    //
}
