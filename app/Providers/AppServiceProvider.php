<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Relations\Relation;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Relation::morphMap([
            'Entrepreneur' => \App\Entrepreneur::class,
            'Ouvrier' => \App\Ouvrier::class,
            'Client' => \App\Client::class
        ]);
        if(Schema::hasTable('type_projets'))
            view()->share('typeProjets', \App\TypeProjet::all());
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
