<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class EmbeddableSearchWidget extends Model
{
    use CrudTrait;

    const TAB_MAIN = 'main';

    const TAB_COMPANIES = 'companies';

    const TAB_PEOPLE = 'people';

    const TAB_INVESTORS = 'investors';

    const TAB_RESEARCH = 'research';

    const TAB_CLINICAL_TRIALS = 'clinical_trials';

    const TAB_EVENTS = 'events';

    const TAB_JOBS = 'jobs';

    const TAB_NEWS_ARTICLES = 'news_articles';

    const TABS = [
        //TODO add main tab after global index will be added
        //        self::TAB_MAIN,
        self::TAB_COMPANIES,
        self::TAB_PEOPLE,
        self::TAB_INVESTORS,
        self::TAB_RESEARCH,
        self::TAB_CLINICAL_TRIALS,
        self::TAB_EVENTS,
        self::TAB_JOBS,
        self::TAB_NEWS_ARTICLES,
    ];

    public $guarded = ['id'];

    public $casts = [
        'tabs' => 'array',
        'filters' => 'array',
    ];

    public function setLogoAttribute($imageValue)
    {
        $diskName = 'public';

        $attributeName = 'logo';
        $currentFilename = $this->{$attributeName};
        $imageFolderPath = 'embed_search_widget';

        // image not changed
        if ($currentFilename && strpos($imageValue, $currentFilename) !== false) {
            return;
        }

        // remove old image file
        if ($currentFilename) {
            $oldImagePath = $imageFolderPath.DIRECTORY_SEPARATOR.$currentFilename;

            Storage::disk($diskName)->delete($oldImagePath);
        }

        // image was erased or set to empty
        if (empty($imageValue)) {
            $this->attributes[$attributeName] = null;

            return;
        }

        // new image uploaded
        $imageFilename = Str::slug($this->name).'.png';
        $imagePath = $imageFolderPath.DIRECTORY_SEPARATOR.$imageFilename;

        if (Str::startsWith($imageValue, 'data:image')) {
            // uploaded via backpack's CRUD
            $image = Image::make($imageValue)->encode('png', 90);

            Storage::disk($diskName)->put($imagePath, $image->stream());
        }

        $this->attributes[$attributeName] = $imageFilename;
    }
}
