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
        Relation::morphMap([
            'organization'   => Company::class,
            'person'         => Person::class,
            'research'       => Research::class,
            'investor'       => Investor::class,
            'location'       => Location::class,
            'focus'          => Focus::class,
            'event'          => Event::class,
            'job'            => Job::class,
            'apply'          => JobApplication::class,
            'clinical-trial' => Clinicaltrial::class,
        ]);
    }
}
