<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RatingOuvrier extends Model
{
	protected $table= 'rating_ouvrier';
	protected $guarded = [];
	public $timestamps = false;
    //
    public function user()
	{
		return $this->belongsTo('App\User');
	}
    public function getUsernameAttribute()
    {
    	return $this->user->nom . " " . $this->user->prenom;
    }

}
