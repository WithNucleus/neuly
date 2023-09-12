<?php

namespace App\Models\ClinicalTrialDetails;

use App\Models\Clinicaltrial;
use Illuminate\Database\Eloquent\Model;

class CtPhase extends Model
{
    protected $table = 'ct_phases';
    public $guarded = ['id'];

    const PHASE_NA = 'NA';
    const PHASE_EARLY_PHASE1 = 'EARLY_PHASE1';
    const PHASE_PHASE1 = 'PHASE1';
    const PHASE_PHASE2 = 'PHASE2';
    const PHASE_PHASE3 = 'PHASE3';
    const PHASE_PHASE4 = 'PHASE4';

    const PHASES = [
        self::PHASE_NA => 'Not Applicable',
        self::PHASE_EARLY_PHASE1 => 'Early Phase 1',
        self::PHASE_PHASE1 => 'Phase 1',
        self::PHASE_PHASE2 => 'Phase 2',
        self::PHASE_PHASE3 => 'Phase 3',
        self::PHASE_PHASE4 => 'Phase 4'
    ];

    public function clinicalTrials(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Clinicaltrial::class, 'clinicaltrial_phase');
    }

    public function getPrettyNameAttribute(): string
    {
        return match($this->name) {
            self::PHASE_NA => 'Not Applicable',
            self::PHASE_EARLY_PHASE1 => 'Early Phase 1',
            self::PHASE_PHASE1 => 'Phase 1',
            self::PHASE_PHASE2 => 'Phase 2',
            self::PHASE_PHASE3 => 'Phase 3',
            self::PHASE_PHASE4 => 'Phase 4'
        };
    }
}
