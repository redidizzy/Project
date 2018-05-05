<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\TypeOuvrier;

class UserTest extends TestCase
{
	use DatabaseMigrations;
    /** @test */
    public function un_ouvrier_doit_avoir_une_fonction()
    {
    	$ouvrierInst = factory('App\Ouvrier')->create();
    	$ouvrier = factory('App\User')->create(['userable_type' => 'Ouvrier', 'userable_id' => $ouvrierInst->id]);

    	$fonction = TypeOuvrier::find($ouvrierInst->fonction);

    	
    	$this->assertInstanceOf(TypeOuvrier::class, $fonction);


    }
}
