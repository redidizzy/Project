<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class GestionUtilisateurTest extends TestCase
{
	use DatabaseMigrations;
    /** @test */
    public function un_utilisateur_peut_voir_ses_informations_dans_sa_page()
    {	
    	$user= factory('App\User')->create();
    	$this->be($user);
    	$this->get(route('utilisateur.profil', $user->id))
    	->assertSee($user->nom);


    }
     /** @test */
     public function les_informations_d_un_entrepreneur_sont_juste()
   {
   	$user= factory('App\User')->create();
    	$this->be($user);

     	$response = $this->get(route('utilisateur.profil', $user->id));
   		 
   		if($user->userable_type === "Entrepreneur")
   		{
     		$response->assertSee($user->userable->experience)
     		->assertSee($user->userable->disponibilite)
     		->assertSee($user->userable->materiel)
     		->assertSee($user->userable->reputation);
     	}
     	else if($user->userable_type === "Ouvrier")
     	{
     		$response->assertSee($user->userable->diplome)
     		->assertSee($user->userable->experience)
     		->assertSee($user->userable->reputation)
     		->assertSee($user->userable->fonction)
     		->assertSee($user->userable->prixApprox);
     	}
     }
}
