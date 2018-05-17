<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOffreEmploiOuvrierTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('offre_emploi_ouvrier', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
			$table->integer('ouvrier_id');
			$table->integer('offreEmploi_id');
			$table->foreign('ouvrier_id')
					->references('id')
					->on('ouvriers');
			$table->foreign('offreEmploi_id')
					->references('id')
					->on('offreEmplois');		
					
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
		
        //
    }
}
