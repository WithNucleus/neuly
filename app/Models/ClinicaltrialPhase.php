<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class ClinicaltrialPhase extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */
     protected $table = 'clinicaltrial_phases';
     protected $primaryKey = 'name';
     protected $fillable = ['name', 'pretty_name', 'integer'];
     public $incrementing = false;

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */
    const PHASE_NA = 'phase_na';
    const PHASE_EARLY_1 = 'phase_early_1';
    const PHASE_1  = 'phase_1';
    const PHASE_1_2 = 'phase_1_2';
    const PHASE_2 = 'phase_2';
    const PHASE_2_3 = 'phase_2_3';
    const PHASE_3 = 'phase_3';
    const PHASE_4 = 'phase_4';

    private static $phases = [
        self::PHASE_NA => [
            'name' => 'Not Applicable',
            'pretty_name' => 'Not Applicable',
            'integer' => 0
        ],
        self::PHASE_EARLY_1 => [
            'name' => 'Early Phase 1',
            'pretty_name' => 'Early Phase 1',
            'integer' => 1
        ],
        self::PHASE_1 => [
            'name' => 'Phase 1',
            'pretty_name' => 'Phase 1',
            'integer' => 2
        ],
        self::PHASE_1_2 => [
            'name' => 'Phase 1|Phase 2',
            'pretty_name' => 'Phase 2',
            'integer' => 3
        ],
        self::PHASE_2 => [
            'name' => 'Phase 2',
            'pretty_name' => 'Phase 2',
            'integer' => 3
        ],
        self::PHASE_2_3 => [
            'name' => 'Phase 2|Phase 3',
            'pretty_name' => 'Phase 3',
            'integer' => 4
        ],
        self::PHASE_3 => [
            'name' => 'Phase 3',
            'pretty_name' => 'Phase 3',
            'integer' => 4
        ],
        self::PHASE_4 => [
            'name' => 'Phase 4',
            'pretty_name' => 'Phase 4',
            'integer' => 5
        ],
    ];

    public static function getPhases()
    {
        return self::$phases;
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
    | ACCESSORS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}
