<?php

namespace App\Models;

use App\Helpers\Entity\FieldsMapping;
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

    protected static $typeValues = [
        'Venture Capital',
        'Private Equity',
        'Private Individual',
    ];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    protected static function booted()
    {
        static::deleting(function ($model) {
            //remove polymorphic relation
            $model->jobs()->delete();
        });
    }

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

    /**
     * @return array
     */
    public static function getTypeValues()
    {
        return self::$typeValues;
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
    /**
     * @param \Illuminate\Database\Query\Builder $query
     * @return \Illuminate\Database\Query\Builder
     */
    public function scopeHasJobs($query) {
        return $query->whereHas('jobs');
    }

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
    public static function getFieldsMapping()
    {
        return [
            //attributes
            'name'      => [
                'type' => FieldsMapping::TYPE_STRING,
                'required' => true,
            ],
            'slug'      => [
                'type' => FieldsMapping::TYPE_STRING,
            ],
            'website'   => [
                'type' => FieldsMapping::TYPE_STRING,
            ],
            'type' => [
                'type' => FieldsMapping::TYPE_ENUM,
                'values' => self::$typeValues,
            ],
            'logo'      => [
                'type' => FieldsMapping::TYPE_IMAGE,
            ],
            //relations
            'locations' => [
                'type'          => FieldsMapping::TYPE_RELATION,
                'relation'      => FieldsMapping::RELATION_N_N,
                'relationField' => 'name',
            ],
            'companies' => [
                'type'          => FieldsMapping::TYPE_RELATION,
                'relation'      => FieldsMapping::RELATION_N_N,
                'relationField' => 'name',
            ],
            'people'    => [
                'type'          => FieldsMapping::TYPE_RELATION,
                'relation'      => FieldsMapping::RELATION_N_N,
                'relationField' => 'name',
                'pivotColumns'  => [
                    'role',
                ],
            ],
        ];
    }

    public static function getListingRequestMapping()
    {
        $mapping = self::getFieldsMapping();
        $skipFields = ['slug', 'people'];

        foreach ($skipFields as $field) {
            unset($mapping[$field]);
        }

        return $mapping;
    }
}
