<?php

namespace App\Search;

use Algolia\ScoutExtended\Searchable\Aggregator;
use App\Enum\MediaTypes;
use App\Models\BookableListing;
use App\Models\Course;
use App\Models\DataFeed;
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
        return match (get_class($model)) {
            Company::class => route('discover.organizations.show', $model->slug),
            Person::class => route('discover.people.show', $model->slug),
            Investor::class => route('discover.investors.show', $model->slug),
            Research::class => route('discover.research.show', $model->slug),
            Clinicaltrial::class, => route('discover.clinicaltrials.show', $model->slug),
            Event::class => route('discover.events.show', $model->slug),
            Job::class => route('discover.jobs.show', $model->slug),
            MediaItem::class, 'Course' => $model->url,
            BookableListing::class => route('discover.bookable-listing.show', $model->slug),
            default => url('')
        };
    }

    private function getModelType($model): string
    {
        $modelType = match (get_class($model)) {
            Company::class => 'Organization',
            Clinicaltrial::class => 'Clinical Trial',
            MediaItem::class => $model->media_type,
            BookableListing::class => $model->type,
            default => class_basename($model)
        };

        if (get_class($model) === MediaItem::class) {
            if ($model->source) {
                if ($model->source->source_category !== DataFeed::SOURCE_GOOGLE_ALERT) {
                    $modelType .= ' - ' . $model->source->name;
                }
            }
        }

        return $modelType;
    }

    private function getKeywords($model): string
    {
        $type = match (get_class($model)) {
            Company::class => 'organizations',
            Clinicaltrial::class => 'clinical trials',
            Person::class => 'people person',
            MediaItem::class => Str::plural($model->media_type),
            BookableListing::class => Str::plural($model->type),
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

        if (get_class($model) === Company::class) {
            $keywords .= $model->ownership . " ";
        }

        if (get_class($model) === Investor::class) {
            $keywords .= $model->type . " ";
        }

        if (get_class($model) === BookableListing::class) {
            $keywords .= $model->location_name . " ";
        }

        if (get_class($model) === Job::class) {
            $keywords .= $model->employment_type . " at " . $model->owner->name . " ";
        }

        return $keywords;
    }

    private function getDescription($model): string
    {
        // Organization
        if (get_class($model) === Company::class) {

            if ($model->ownership) {
                return $model->ownership;
            }
        }

        // Person
        if (get_class($model) === Person::class) {
            return strip_tags($model->byline ?? $model->bio);
        }

        // Investor
        if (get_class($model) === Investor::class) {
            return $model->type;
        }

        // Research
        if (get_class($model) === Research::class) {
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
        if (get_class($model) === Clinicaltrial::class) {
            return $model->nct_number . ' ' . strip_tags($model->brief_summary);
        }

        // Event
        if (get_class($model) === Event::class) {
            return strip_tags(html_entity_decode($model->description));
        }

        // Job
        if (get_class($model) === Job::class) {
            return strip_tags(html_entity_decode($model->job_description));
        }

        // MediaItem
        if (get_class($model) === MediaItem::class) {
            return strip_tags(html_entity_decode($model->summary ?? $model->content));
        }

        // Course
        if (get_class($model) === MediaItem::class) {
            return strip_tags($model->summary);
        }

        // BookableListing
        if (get_class($model) === BookableListing::class) {

            $firstContent = $model->content()->first();

            if ($firstContent) {
                return strip_tags($firstContent);
            }

            return 'Bookable ' . $model->type;
        }

        return '';

    }

    private function getImage($model): string
    {
        $image = match (get_class($model)) {
            Company::class, Investor::class, Person::class, Event::class =>  $model->entityImageUrl,
            Research::class => '/images/icons/research.svg',
            Clinicaltrial::class => '/images/icons/clinicaltrials.svg',
            Job::class => '/images/icons/jobs.svg',
            MediaItem::class => $model->icon_url,
            default => '/images/favicons/android-chrome-192x192.png'
        };

        if (!$image) {
            return config('scout.image_url_prefix') . '/images/favicons/android-chrome-192x192.png';
        }

        if (get_class($model) === MediaItem::class) {
            return $image;
        }

        return config('scout.image_url_prefix') . $image;
    }
}
