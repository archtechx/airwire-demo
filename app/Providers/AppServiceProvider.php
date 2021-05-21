<?php

namespace App\Providers;

use Airwire\Airwire;
use App\Airwire\CreateReport;
use App\Airwire\CreateUser;
use App\Airwire\ReportFilter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use MyDTO;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Airwire::component('report-filter', ReportFilter::class);
        Airwire::component('create-report', CreateReport::class);
        Airwire::component('create-user', CreateUser::class);

        Model::unguard();
    }
}
