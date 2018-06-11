<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projets', function (Blueprint $table) {
            $table->integer('type_id')->nullable();
            $table->integer('client_id');
            $table->text('description');
            $table->double('superficie');
            $table->integer('wilaya');
            $table->string('region');
            $table->double('budget');
            $table->string('delai');
            $table->boolean('necessiteEntrepreneur'); 
            $table->string('adresse');           
            $table->increments('id');
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
        Schema::dropIfExists('projets');
    }
}
