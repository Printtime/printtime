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
            'orders' => Order::class,
        ]);

        #Dfms::register('dfms', App\Admin\FormItems\Dfms::class);
        view()->composer('layouts.app', 'App\Http\Controllers\Controller');
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
