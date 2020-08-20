<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;
use Spatie\QueryBuilder\QueryBuilderRequest;
use App\Models\Clinicaltrial;
use App\Models\JobApplication;
use App\Models\Job;
use App\Models\Event;
use App\Models\Focus;
use App\Models\Location;
use App\Models\Investor;
use App\Models\Research;
use App\Models\Person;
use App\Models\Company;

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
        QueryBuilderRequest::setArrayValueDelimiter('|');
    }
}
