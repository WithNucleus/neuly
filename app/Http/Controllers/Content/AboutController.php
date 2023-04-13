<?php

namespace App\Http\Controllers\Content;

use App\Http\Controllers\Controller;
use App\Models\BookableListing;
use App\Models\Clinicaltrial;
use App\Models\Company;
use App\Models\Course;
use App\Models\Event;
use App\Models\Investor;
use App\Models\Job;
use App\Models\Location;
use App\Models\MediaItem;
use App\Models\Person;
use App\Models\Research;
use App\Services\Metas;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index(Request $request)
    {
        // Metas
        $metas = Metas::fromPage($request->path());

        $organizationsCount = Company::count();
        $peopleCount = Person::count();
        $investorsCount = Investor::count();
        $locationsCount = Location::count();
        $researchCount = Research::count();
        $clinicalTrialsCount = Clinicaltrial::count();
        $eventsCount = Event::count();
        $jobsCount = Job::count();
        $newsCount = MediaItem::news()->count();
        $booksCount = MediaItem::books()->count();
        $podcastsCount = MediaItem::podcasts()->count();
        $coursesCount = Course::count();
        $videosCount = MediaItem::videos()->count();
        $careCount = BookableListing::practitioners()->public()->count();

        return view('content.about.index', [
            'metas' => $metas,
            'organizationsCount' => $organizationsCount,
            'peopleCount' => $peopleCount,
            'investorsCount' => $investorsCount,
            'locationsCount' => $locationsCount,
            'researchCount' => $researchCount,
            'clinicalTrialsCount' => $clinicalTrialsCount,
            'eventsCount' => $eventsCount,
            'jobsCount' => $jobsCount,
            'newsCount' => $newsCount,
            'booksCount' => $booksCount,
            'podcastsCount' => $podcastsCount,
            'coursesCount' => $coursesCount,
            'videosCount' => $videosCount,
            'careCount' => $careCount
        ]);
    }
}
