<?php

namespace App\Providers;

use App\Support\Directory;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

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
        $modules = Directory::listDirectories(base_path('Modules'));
        foreach ($modules as $module) {
            $routesPath = base_path('Modules/' . $module . '/Routes');
            $viewsPath = base_path('Modules/' . $module . '/Views');
            $routesFiles = Directory::listContents($routesPath);
            foreach ($routesFiles as $routesFile) {
                if (file_exists($routesPath . '/' . $routesFile)) {
                    require $routesPath . '/' . $routesFile;
                } else {
                    dd($routesPath . '/' . $routesFile);
                }
            }


            if (file_exists($viewsPath)) {
                $this->app->view->addLocation($viewsPath);
            } else {
              dd($viewsPath);
            }
        }
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
