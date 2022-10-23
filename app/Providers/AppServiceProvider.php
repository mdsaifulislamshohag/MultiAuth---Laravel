<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use View;
use App\App;
use App\Email;
use App\ToDo;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);


        View::composer('*', function($view){
           $view->with('app', App::get()->first());
        });

        View::composer('*', function($view){
           $view->with('msgtop', Email::orderBy('id', 'DESC')->get()->where('sender', '1')
                                                                    ->where('read', '0')
                                                                    ->where('trash', '0'));
        });

        View::composer('*', function($view){
           $view->with('tasktop', ToDo::get());
        });
        View::composer('*', function($view){
           $view->with('taskcount', ToDo::get()->where('status', 0));
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
