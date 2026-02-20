<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use File;

class ModuleServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $modules = File::directories(app_path('Modules'));

        foreach ($modules as $module) {
            $routeFiles = glob($module.'/Routes/*.php');

            foreach ($routeFiles as $route) {
                $this->loadRoutesFrom($route);
            }
        }
    }

    public function register() {}
}