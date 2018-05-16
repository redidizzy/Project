<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ouvrier extends Model
{
	protected $guarded = [];
	public function user()
	{
		return $this->morphOne('App\User', 'userable');
	}
  public function demandes()
  {
    return $this->hasMany('App\DemandeEmploi');
  }
    public function scopeFonction($query, $fonction)
    {
    	return $query->where('fonction', $fonction);
    }
    public function scopeNom($query, $nom)
    {
    	return $query->whereHas('user', function($x) use ($nom) {
    		$x->where('nom', $nom);
    	});
    }
    public function scopePrenom($query, $prenom)
    {
    	return $query->whereHas('user', function($x) use ($prenom) {
    		$x->where('prenom', $prenom);
    	});
    }
    public function scopeReputation($query, $operateur, $reputation)
    {
    	return $query->where('reputation', $operateur, $reputation);
   }
   public function scopePrixApprox($query, $operateur, $prixApprox)
   {
   		return $query->where('prixApprox'. $operateur, $prixApprox);
   }
   public function scopeExperience($query, $operateur, $experience)
   {
   		return $query->where('experience', $operateur, $experience);
   }
   public function scopeRegion($query, $region)
   {
   		return $query->whereHas('user', function($x) use($region){
   			$x->where('region', $region);
   		});
   }
   public function scopeWilaya($query, $wilaya)
   {
   		return $query->whereHas('user', function($x) use($wilaya){
   			$x->where('wilaya', $wilaya);
   		});
   }
   public function scopeDiplome($query, $bool)
   {
   	return $query->where('diplome', $bool);
   }
	
	
	public function diplomes()
	{
		return $this->hasMany('App\Diplome');
	}
}
