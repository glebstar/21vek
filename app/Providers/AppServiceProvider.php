<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Object;
use DB;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*', function($view){
            $view->with([
                'countObj' => Object::select(DB::raw('count(*) as cnt'))
                    ->where('is_trash', 0)
                    ->first()->cnt
            ]);
        });
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
