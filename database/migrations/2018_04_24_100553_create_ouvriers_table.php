<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOuvriersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ouvriers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('experience');
            $table->double('reputation');
            $table->string('fonction', 191);
            $table->string('prixApprox');
            $table->foreign('fonction')
                ->references('designation')
                ->on('type_ouvriers')
				->onDelete('cascade')
				->onUpdate('cascade');

             $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ouvriers');
    }
}
