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
			$table->integer('offre_emploi_id');
			$table->foreign('ouvrier_id')
					->references('id')
					->on('ouvriers');
			$table->foreign('offre_emploi_id')
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

        Schema::table('offre_emploi_ouvrier', function(Blueprint $table) {

            $table->dropForeign('offre_emploi_ouvrier_ouvrier_id_foreign');
            $table->dropForeign('offre_emploi_ouvrier_offre_emploi_id_foreign');

        });

        Schema::drop('offre_emploi_ouvrier');

    }
}
