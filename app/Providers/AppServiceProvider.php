<?php

namespace App\Providers;

use App\Models\InsightRequest;
use App\Models\JobReportEntry;
use App\Models\ListingRequest;
use App\Search\AutoSuggest;
use Illuminate\Support\ServiceProvider;
use Spatie\QueryBuilder\QueryBuilderRequest;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Paginator::useBootstrap();
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        QueryBuilderRequest::setArrayValueDelimiter('|');

        AutoSuggest::bootSearchable();

        view()->composer('backpack::inc.sidebar_content', function($view) {
            $view->with([
                'countListingRequests' => ListingRequest::open()->count(),
                'countInsightRequests' => InsightRequest::count(),
                'countJobReports' => JobReportEntry::count(),
            ]);
        });
    }
}
