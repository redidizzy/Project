<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TypeProjet extends Model
{
	public function projets()
	{
		return $this->hasMany(Projet::class, 'type_id');
	}
}
