<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AttestationOuvrier extends Model
{
	protected $guarded = [];
	protected $table = 'attestation_ouvriers';

	public function ouvrier()
	{
		return $this->belongsTo('App\Ouvrier');
	}
    //
}
