<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Diplome;
use App\User;
use App\DemandeEmploi;
use App\TypeOuvrier;
use App\OffreEmploi;

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
    	return $query->whereHas('ratings', function($q) use($reputation, $operateur){
        $q->groupBy('ouvrier_id')->havingRaw('AVG(rating) '.$operateur . $reputation);
      });
    }
   public function scopePrixApprox($query, $operateur, $prixApprox)
   {
   		return $query->where('prixApprox', $operateur, $prixApprox);
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
   public function scopeDiplome($query)
   {
   	return $query->whereHas('diplomes');
   }

   public function attestations(){
    return $this->hasMany('App\AttestationOuvrier');
   }
	
	
	public function diplomes()
	{
		return $this->hasMany('App\Diplome');
	}

	
	
	public function type()
	{
		return $this->hasOne('App\TypeOuvrier');
	}
	//pour recuperer les offres d'emploi en relation avec un ouvrier 
	public function offres()
	{
		return $this->belongsToMany('App\OffreEmploi');
	}
  public function ratings()
  {
    return $this->hasMany('App\RatingOuvrier');
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
  public function dejaPostule($offre)
  {
    $result = false;

    foreach($offre->ouvriers as $x)
    {
      if($x->pivot->ouvrier_id = $this->id)
        $result=true;
    }
    return $result;
  }
}
	
	

