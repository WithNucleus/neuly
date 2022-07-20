<?php

namespace App\Search;

use Algolia\ScoutExtended\Searchable\Aggregator;
use App\Models\BookableListing;
use App\Models\Course;
use App\Models\MediaItem;
use \App\Models\Company;
use \App\Models\Person;
use \App\Models\Investor;
use \App\Models\Research;
use \App\Models\Clinicaltrial;
use \App\Models\Event;
use \App\Models\Job;
use Illuminate\Support\Str;

class AutoSuggest extends Aggregator
{
//    private const INDEX = 'general_query_suggestions';
    private const INDEX = 'everything';
    /**
     * The names of the models that should be aggregated.
     *
     * @var string[]
     */
    protected $models = [
        Company::class,
        Person::class,
        Investor::class,
        Research::class,
        Clinicaltrial::class,
        Event::class,
        Job::class,
        MediaItem::class,
        Course::class,
        BookableListing::class
    ];

    public function toSearchableArray(): array
    {
        return [
            'name' => $this->model->name,
            'url' => $this->getUrl($this->model),
            'description' => $this->getDescription($this->model),
            'image' => $this->getImage($this->model),
            'type' => $this->getModelType($this->model),
            'keywords' => $this->getKeywords($this->model)
        ];

        // TODO: Add date fields (if model has date field, use that, otherwise use updated_at)
    }

    public function searchableAs(): string
    {
        return config('scout.prefix') . self::INDEX;
    }

    private function getUrl($model): string
    {
        return match (class_basename($model)) {
            'Company', => route('discover.organizations.show', $model->slug),
            'Person', => route('discover.people.show', $model->slug),
            'Investor', => route('discover.investors.show', $model->slug),
            'Research', => route('discover.research.show', $model->slug),
            'Clinicaltrial', => route('discover.clinicaltrials.show', $model->slug),
            'Event', => route('discover.events.show', $model->slug),
            'Job', => route('discover.jobs.show', $model->slug),
            'MediaItem', 'Course', => $model->url,
            'BookableListing', => route('discover.bookable-listing.show', $model->slug),
            default => url('')
        };
    }

    private function getModelType($model): string
    {
        return match (class_basename($model)) {
            'Company', => 'Organization',
            'Clinicaltrial', => 'Clinical Trial',
            'MediaItem' => $model->media_type,
            'BookableListing' => $model->type,
            default => class_basename($model)
        };
    }

    private function getKeywords($model): string
    {
        // TODO: Also for Media Items -- add plural type to model

        $type = match (class_basename($model)) {
            'Company', => 'organizations ' . $model->ownership,
            'Clinicaltrial', => 'clinical trials',
            'Person', => 'people person',
            'MediaItem' => Str::plural($model->media_type),
            'BookableListing' => Str::plural($model->type),
            default => class_basename($model)
        };

        $keywords = '';

        if ($model->focus) {
            foreach ($model->focus as $focus) {
                if ($focus->name !== 'Clinic') {
                    $keywords .= $focus->name . " " . $type . " ";
                }
            }
        }

        if ($model->locations) {
            foreach ($model->locations as $location) {
                $keywords .= $location->name . " ";
            }
        }

        if (class_basename($model) === 'BookableListing') {
            $keywords .= $model->location_name . " ";
        }

        if (class_basename($model) === 'Job') {
            $keywords .= $model->employment_type . " at " . $model->owner->name . " ";
        }

        return $keywords;
    }

    private function getDescription($model): string
    {
        // Organization
        if (class_basename($model) === 'Company') {

            // TODO: Entity Content

            if ($model->ownership) {
                return $model->ownership;
            }
        }

        // Person
        if (class_basename($model) === 'Person') {
            return strip_tags($model->byline ?? $model->bio);
        }

        // Investor
        if (class_basename($model) === 'Investor') {
            return $model->type;
        }

        // Research
        if (class_basename($model) === 'Research') {
            $description = '';

            if ($model->publication_info) {
                $description .= $model->publication_info;
            }

            if ($model->publication_info AND $model->abstract) {
                $description .= '; ';
            }

            if ($model->abstract) {
                $description .= $model->abstract;
            }

            return strip_tags($description);
        }

        // Clinical Trial
        if (class_basename($model) === 'Clinicaltrial') {
            return $model->nct_number . ' ' . strip_tags($model->brief_summary);
        }

        // Event
        if (class_basename($model) === 'Event') {
            return strip_tags(html_entity_decode($model->description));
        }

        // Job
        if (class_basename($model) === 'Job') {
            return strip_tags(html_entity_decode($model->job_description));
        }

        // MediaItem
        if (class_basename($model) === 'MediaItem') {
            return strip_tags(html_entity_decode($model->summary ?? $model->content));
        }

        // Course
        if (class_basename($model) === 'MediaItem') {
            return strip_tags($model->summary);
        }

        // BookableListing
        if (class_basename($model) === 'BookableListing') {
            // TODO: Entity Content
            return 'Bookable ' . $model->type;
        }

        return '';

    }

    private function getImage($model): string
    {
        $image = match (class_basename($model)) {
            'Company', 'Investor', 'Person', 'Event', =>  $model->entityImageUrl,
            'Research', => '/images/icons/research.svg',
            'Clinicaltrial', => '/images/icons/clinicaltrials.svg',
            'Job', => '/images/icons/jobs.svg',
            default => '/images/favicons/android-chrome-192x192.png'
        };

        if (!$image) {
            return config('scout.image_url_prefix') . '/images/favicons/android-chrome-192x192.png';
        }

        return config('scout.image_url_prefix') . $image;
    }
}
