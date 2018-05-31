<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Entrepreneur extends Model
{
	protected $guarded = [];
	public function user()
	{
		return $this->morphOne('App\User', 'userable');
	}

	public function attestations()
	{
		return $this->hasMany('App\AttestationEntrepreneur');
	}

	
	public function offres()
	{
	 	return $this->hasMany('App\OffreEmploi');
	}

  public function ratings()
  {
    return $this->hasMany('App\RatingEntrepreneur');
  }
 
   public function finalRating()
  {
    $x = 0;
    foreach($this->ratings as $r)
    {
      $x += $r->rating;
    }
    return ($this->ratings->count() == 0 ) ? 0 : $x / $this->ratings->count();
  }

  //scope queries
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
    	return $query->whereHas('ratings', function($q) use($reputation, $operateur){
    		$q->groupBy('entrepreneur_id')->havingRaw('AVG(rating) '.$operateur . $reputation);
    	});
    }
    public function scopeDateDispoMin($query, $date)
    {
    	return $query->where('dateDebutDispo', '<=', $date);
    }
    public function scopeDateDispoMax($query, $date)
    {
    	return $query->where('dateFinDispo', '>=', $date);
    }
    public function scopeExperience($query, $operateur, $experience)
   	{
      if($experience == 0 and $operateur == '>=')
        return $query;
      else if($experience == 0 and $operateur == '<=')
        return $query->whereDoesntHave('attestations');
      else
   		 return $query->whereHas('attestations', function($q) use ($experience, $operateur) {
         $q->groupBy('id')->havingRaw('Count(*)'. $operateur . $experience);
       });
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
}
