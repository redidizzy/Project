<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class OffreOuvrier extends Pivot
{
    public function ouvrier()
	{
		return $this->belongsTo('App\Ouvrier');
	}
	
	public function offre()
	{
		return $this->belongsTo('App\OffreEmploi');
	}
	
}
