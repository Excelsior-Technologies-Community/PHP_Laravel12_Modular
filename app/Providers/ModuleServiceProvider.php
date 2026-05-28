<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;

class ModuleServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if (File::exists(app_path('Modules'))) {
            $modules = File::directories(app_path('Modules'));

            foreach ($modules as $module) {
                $routeFiles = glob($module . '/Routes/*.php');

                foreach ($routeFiles as $route) {
                    Route::middleware('web')->group($route);
                }
            }
        }
    }

    public function register()
    {
    }
}