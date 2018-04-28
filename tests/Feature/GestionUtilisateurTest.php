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
    	$this->get(route('utilisateur.profil', $user))
    	->assertSee($user->nom);


    }
}
