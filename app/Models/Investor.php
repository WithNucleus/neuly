<?php

namespace App\Models;

use App\Helpers\EntityMergeHelper;
use App\Models\Contracts\EntityContract;
use App\Models\Traits\CrudShowEntityPageButton;
use App\Models\Traits\OldSlugRedirectable;
use App\Traits\HasFollowers;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Spatie\Activitylog\Traits\LogsActivity;

class Investor extends Model implements EntityContract
{
    use CrudTrait;
    use HasFollowers;
    use OldSlugRedirectable;
    use LogsActivity;
    use CrudShowEntityPageButton;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'investors';
    protected $guarded = ['id'];

    // log activity for all attributes, which not listed in $guarded array
    protected static $logUnguarded = true;
    protected static $logName = 'entities';

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    public function getShowLink() {
        return '<a href="' . route('discover.investors.show', $this->slug) . '">' . $this->name . '</a>';
    }

    public function getTypeDescription() {
        if ($this->type === 'Private Individual') {
            return 'a ' . strtolower($this->type);
        } else {
            return 'a ' . strtolower($this->type) . ' firm';
        }
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    public function locations() {
        return $this->belongsToMany('App\Models\Location', 'investor_location', 'investor_id', 'location_id')
            ->withTimestamps();
    }

    public function companies() {
        return $this->belongsToMany('App\Models\Company', 'company_investor', 'investor_id', 'company_id')
            ->withPivot(['type'])
            ->withTimestamps();
    }

    public function people() {
        return $this->belongsToMany('App\Models\Person', 'investor_person', 'investor_id', 'person_id')
            ->withPivot(['role'])
            ->withTimestamps();
    }

    public function companyValuations()
    {
        return $this->belongsToMany(CompanyValuation::class);
    }

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | ACCESSORS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */

    public function setNameAttribute($value) {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    public function setLogoAttribute($value)
    {
        $investor_name    = Str::slug($this->name);
        $filename         = 'investor-' . $investor_name . '.png';
        $attribute_name   = "logo";
        $disk             = 'local';
        $public_path      = "public/";
        $destination_path = $public_path . "logos";

        // if the image was erased
        if ($value === null) {
            Storage::disk($disk)->delete($this->{$attribute_name});
            return $this->attributes[$attribute_name] = null;
        }

        // if a base64 was sent, store it in the db
        if (Str::startsWith($value, 'data:image'))
        {
            $image = Image::make($value)->encode('png', 90);

            Storage::disk($disk)->delete($this->{$attribute_name});
            Storage::disk($disk)->put($destination_path.'/'.$filename, $image->stream());

            $public_destination_path = Str::replaceFirst($public_path, '', $destination_path);

            return $this->attributes[$attribute_name] = $public_destination_path.'/'.$filename;
        }

        $oldValue = Storage::disk($disk)->url($this->{$attribute_name});

        //if another already uploaded image was assigned (e.g. after Entity Merge)
        if ($value !== null && $oldValue != $value) {
            $oldImagePath = $public_path . $this->{$attribute_name};
            $newImagePath = $public_path . $value;
            //delete old image from disk
            Storage::disk($disk)->delete($oldImagePath);
            //replace old image with new
            Storage::disk($disk)->move($newImagePath, $oldImagePath);
            //assign back correct old image value
            return $this->attributes[$attribute_name] = $this->{$attribute_name};
        }
    }

    /**
     * @return array
     */
    public static function getMergeMapping()
    {
        return [
            //attributes
            'name'      => [
                'type' => EntityMergeHelper::TYPE_STRING,
            ],
            'slug'      => [
                'type' => EntityMergeHelper::TYPE_STRING,
            ],
            'website'   => [
                'type' => EntityMergeHelper::TYPE_STRING,
            ],
            'type'      => [
                'type' => EntityMergeHelper::TYPE_STRING,
            ],
            'logo'      => [
                'type' => EntityMergeHelper::TYPE_IMAGE,
            ],
            //relations
            'locations' => [
                'type'          => EntityMergeHelper::TYPE_RELATION,
                'relation'      => EntityMergeHelper::RELATION_N_N,
                'relationField' => 'name',
            ],
            'focus'     => [
                'type'          => EntityMergeHelper::TYPE_RELATION,
                'relation'      => EntityMergeHelper::RELATION_N_N,
                'relationField' => 'name',
            ],
            'companies' => [
                'type'          => EntityMergeHelper::TYPE_RELATION,
                'relation'      => EntityMergeHelper::RELATION_N_N,
                'relationField' => 'name',
                'pivotColumns'  => [
                    'type'
                ],
            ],
            'people'    => [
                'type'          => EntityMergeHelper::TYPE_RELATION,
                'relation'      => EntityMergeHelper::RELATION_N_N,
                'relationField' => 'name',
                'pivotColumns'  => [
                    'role'
                ],
            ],
        ];
    }
}
