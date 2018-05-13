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
	public function type()
	{
		return $this->belongsTo(TypeProjet::class);
	}
	//Projet par nom du proprio
	public function scopeNomClient($query, $nom)
	{
		return $query->whereHas('client', function($client) use ($nom){
			$client->whereHas('user', function($user) use ($nom){
				$user->where('nom', $nom);

			});
		});
	}
    //Projet par prenom du proprio
    public function scopePrenomClient($query, $prenom)
	{
		return $query->whereHas('client', function($client) use ($prenom){
			$client->whereHas('user', function($user) use ($prenom){
				$user->where('prenom', $prenom);

			});
		});
	}
	//Projet par superficie
	public function scopeSuperficie($query, $operateur, $superficie)
	{
		return $query->where('superficie', $operateur, $superficie);
	}
	//projet par budget
	public function scopeBudget($query, $operateur, $budget)
	{
		return $query->where('budget', $operateur, $budget);
	}
	//projet par wilaya
	public function scopeWilaya($query, $wilaya)
	{
		return $query->where('wilaya', $wilaya);
	}
	//Projet par region
	public function scopeRegion($query, $region)
	{
		return $query->where('region', $region);
	}
	//projet par Type(apparement il y'a un bug si on appelle la fonction scopeType2)
	public function scopeCategorie($query, $type)
	{
		$query->whereHas('type', function($t) use ($type){

			$t->where('designation', $type);
		});
	}
	public function scopeNecessiteEntrepreneur($query, $bool)
	{
		$query->where('necessiteEntrepreneur', $bool);
	}

}
