<?php

namespace App\Models;

use App\Helpers\Entity\FieldsMapping;
use App\Models\Contracts\EntityContract;
use App\Models\Traits\CrudShowEntityPageButton;
use App\Models\Traits\OldSlugRedirectable;
use App\Models\Traits\SearchableEntity;
use App\Traits\HasFollowers;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\Activitylog\Traits\LogsActivity;

class Research extends Model implements EntityContract
{
    use CrudTrait;
    use HasFollowers;
    use OldSlugRedirectable;
    use LogsActivity;
    use CrudShowEntityPageButton;
    use SearchableEntity;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'research';
    protected $guarded = ['id'];

    // log activity for all attributes, which not listed in $guarded array
    protected static $logUnguarded = true;
    protected static $logName = 'entities';

    private $searchableRelationships = [
        'companies' => 'name',
        'focus' => 'name',
        'people' => 'name',
    ];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    public function getShowLink() {
        return '<a href="' . route('discover.research.show', $this->slug) . '">' . $this->name . '</a>';
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    public function focus() {
        return $this->belongsToMany(Focus::class, 'focus_research', 'research_id', 'focus_id')
                    ->withTimestamps();
    }

    public function companies() {
        return $this->belongsToMany(Company::class, 'company_research', 'research_id', 'company_id')
                    ->withTimestamps();
    }

    public function people() {
        return $this->belongsToMany(Person::class, 'person_research', 'research_id', 'person_id')
                    ->withTimestamps();
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
        $this->attributes['slug'] = isset($this->attributes['slug']) ? $this->attributes['slug'] : Str::slug($value);
    }

    /**
     * @return array
     */
    public static function getFieldsMapping()
    {
        return [
            //attributes
            'name'             => [
                'type' => FieldsMapping::TYPE_STRING,
                'required' => true,
            ],
            'slug'             => [
                'type' => FieldsMapping::TYPE_STRING,
            ],
            'abstract'         => [
                'type' => FieldsMapping::TYPE_TEXT_EDITOR,
            ],
            'link'             => [
                'type' => FieldsMapping::TYPE_STRING,
            ],
            'publish_date'     => [
                'type' => FieldsMapping::TYPE_STRING,
            ],
            'publication_info' => [
                'type' => FieldsMapping::TYPE_STRING,
            ],
            'api_identifier'   => [
                'type' => FieldsMapping::TYPE_STRING,
            ],
            'resources'        => [
                'type' => FieldsMapping::TYPE_TEXT_EDITOR,
            ],
            //relations
            'focus'            => [
                'type'          => FieldsMapping::TYPE_RELATION,
                'relation'      => FieldsMapping::RELATION_N_N,
                'relationField' => 'name',
            ],
            'companies'        => [
                'type'          => FieldsMapping::TYPE_RELATION,
                'relation'      => FieldsMapping::RELATION_N_N,
                'relationField' => 'name',
            ],
            'people'           => [
                'type'          => FieldsMapping::TYPE_RELATION,
                'relation'      => FieldsMapping::RELATION_N_N,
                'relationField' => 'name',
            ],
        ];
    }
}
