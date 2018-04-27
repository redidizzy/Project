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
            $table->timestamps();
            $table->boolean('diplome');
            $table->integer('experience');
            $table->double('reputation');
            $table->string('fonction');
            $table->string('prixApprox');
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
