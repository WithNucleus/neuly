<?php

namespace App\Models;

use App\Helpers\EntityMergeHelper;
use App\Models\Contracts\EntityContract;
use App\Models\Contracts\EntityImageContract;
use App\Models\Traits\CrudShowEntityPageButton;
use App\Models\Traits\EntityImage;
use App\Models\Traits\OldSlugRedirectable;
use App\Traits\HasFollowers;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\Activitylog\Traits\LogsActivity;

class Investor extends Model implements EntityContract, EntityImageContract
{
    use CrudTrait;
    use HasFollowers;
    use OldSlugRedirectable;
    use LogsActivity;
    use CrudShowEntityPageButton;
    use EntityImage;

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

    protected static $imageAttribute = 'logo';
    protected static $imageFolderPath = 'investors';
    protected static $imageFilenameAttribute = 'name';
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

    public function jobs() {
        return $this->morphMany(Job::class, 'owner');
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
        $this->updateImageAttribute($value);
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
