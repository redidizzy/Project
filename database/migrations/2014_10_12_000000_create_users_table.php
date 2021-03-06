<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nom');
            $table->string('prenom');
            $table->string('numTel');
            $table->integer('wilaya');
            $table->string('region');
            $table->string('email', 191)->unique();
            $table->string('photoProfil');
            $table->string('password');
            $table->date('dateNaiss');
            $table->rememberToken();
            $table->timestamps();
            $table->integer('userable_id');
            $table->string('userable_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
