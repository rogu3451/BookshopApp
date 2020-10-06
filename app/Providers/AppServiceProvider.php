<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View; 
use Illuminate\Support\Facades\App; 

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(\App\Twojaksiegarnia\Interfaces\FrontendRepositoryInterface::class, function(){
            
            return new \App\Twojaksiegarnia\Repositories\FrontendRepository;
            
        });
        
         $this->app->bind(\App\Twojaksiegarnia\Interfaces\BackendRepositoryInterface::class, function(){
            
            return new \App\Twojaksiegarnia\Repositories\BackendRepository;
            
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        
        //
    }
}
