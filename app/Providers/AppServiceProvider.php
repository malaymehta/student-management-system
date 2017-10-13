<?php

namespace App\Providers;

use App\Interfaces\DepartmentInterface;
use App\Interfaces\DesignationInterface;
use App\Repositories\DepartmentRepository;
use App\Repositories\DesignationRepository;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        require app_path() . '/Helpers/helpers.php';
        Schema::defaultStringLength(191);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(DepartmentInterface::class, DepartmentRepository::class);
        $this->app->bind(DesignationInterface::class, DesignationRepository::class);
    }
}
