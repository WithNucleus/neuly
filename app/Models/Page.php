<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Model;
use Storage;
use Str;

class Page extends Model
{
    use CrudTrait;
    use Sluggable;
    use SluggableScopeHelpers;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'pages';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = ['template', 'name', 'title', 'slug', 'content', 'extras', 'meta_image'];

    protected $fakeColumns = ['extras'];

    protected $casts = [
        'extras' => 'array',
    ];

    /**
     * Return the sluggable configuration array for this model.
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'slug_or_title',
            ],
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    public function getTemplateName()
    {
        return str_replace('_', ' ', Str::title($this->template));
    }

    public function getPageLink()
    {
        return url($this->slug);
    }

    public function getOpenButton()
    {
        return '<a class="btn btn-sm btn-link" href="'.$this->getPageLink().'" target="_blank">'.
            '<i class="la la-eye"></i> '.trans('backpack::pagemanager.open').'</a>';
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | ACCESORS
    |--------------------------------------------------------------------------
    */

    public function getSlugOrTitleAttribute()
    {
        if ($this->slug != '') {
            return $this->slug;
        }

        return $this->title;
    }

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */

    public function setMetaImageAttribute($value)
    {
        $disk = 'local';
        $destination_path = 'public/page';

        $storage = Storage::disk($disk);

        if (is_null($value)) {
            $storage->delete(Str::replaceFirst('storage/', 'public/', $this->meta_image));
            $this->attributes['meta_image'] = $value;
        } else {
            if (Str::startsWith($value, 'data:image')) {
                // Get extension
                @[$type, $file_data] = explode(';', $value);
                @[, $file_data] = explode(',', $file_data);

                $extension = substr(strrchr($type, '/'), 1);
                // Note We can't use $this->id since initialy the Page is
                // still not saved so no ID.
                $filename = md5(uniqid()).".{$extension}";

                // Save image into storage
                $storage->put("{$destination_path}/{$filename}", base64_decode($file_data));

                // Save path into database
                $this->attributes['meta_image'] = 'storage/'.Str::replaceFirst('public/', '', $destination_path)."/{$filename}";
            }
        }

        // TODO Delete image when deleting the model
        // See https://backpackforlaravel.com/docs/4.1/crud-fields#image
    }
}
