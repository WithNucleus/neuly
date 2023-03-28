<?php

namespace App\Jobs\AutoTag;

use App\Models\Company;
use App\Models\Focus;
use App\Models\MediaItem;
use App\Models\Person;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class TagMediaItem implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected MediaItem $mediaItem;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(MediaItem $mediaItem)
    {
        $this->mediaItem = $mediaItem;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $focuses = Focus::drugs()->pluck('name', 'id')->toArray();
        $organizations = Company::pluck('name', 'id')->toArray();
        $people = Person::pluck('name', 'id')->toArray();

        $content = $this->mediaItem->name.' '.$this->mediaItem->summary.' '.$this->mediaItem->content;

        $focusArray = $this->searchRelationships($focuses, $content);
        $organizationArray = $this->searchRelationships($organizations, $content);
        $peopleArray = $this->searchRelationships($people, $content);

        $this->mediaItem->focus()->syncWithoutDetaching($focusArray);
        $this->mediaItem->companies()->syncWithoutDetaching($organizationArray);
        $this->mediaItem->people()->syncWithoutDetaching($peopleArray);
    }

    private function searchRelationships($termList, $content, $caseSensitive = false): array
    {
        $termArray = [];

        foreach ($termList as $id => $term) {
            $termSearch = str_replace(['/', '&'], '', $term);

            if ($caseSensitive === true) {
                $termSearch = strtolower($termSearch);
            }

            if (preg_match("/\s$termSearch\s/", $content)) {
                array_push($termArray, $id);
            }
        }

        return $termArray;
    }
}
