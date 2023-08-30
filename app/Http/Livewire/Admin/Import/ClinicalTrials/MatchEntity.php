<?php

namespace App\Http\Livewire\Admin\Import\ClinicalTrials;

use App\Models\Clinicaltrial;
use App\Models\ClinicalTrialDetails\CtCondition;
use App\Models\ClinicalTrialDetails\CtIntervention;
use App\Models\ClinicaltrialPhase;
use App\Models\Company;
use App\Models\Focus;
use App\Models\ImportedEntity;
use App\Models\Person;
use Carbon\Carbon;
use Livewire\Component;
use Throwable;

class MatchEntity extends Component
{
    public ImportedEntity $importedEntity;
    public $clinicalTrial;
    public bool $showPage = false;

    public function mount() {
        if ($this->importedEntity->importable) {
            $this->clinicalTrial = $this->importedEntity->importable;

        } else {
            $match = Clinicaltrial::where('nct_number', $this->importedEntity->name)->first();

            if ($match) {
                $this->clinicalTrial = $match;
                $this->importedEntity->importable_id = $match->id;
                $this->importedEntity->save();
            }
        }
    }

    public function createEntity() {
        try {
            $clinicalTrial = Clinicaltrial::create($this->getDataAttributes());
            $this->clinicalTrial = $clinicalTrial;
            $this->matchConditionRelationships();
            $this->matchInterventionRelationships();
            $this->matchLeadSponsor();
            $this->matchResponsibleParty();
            $this->matchCollaborators();
            $this->maskingInfo();
            $this->getArmsGroups();
            $this->getAgeGroups();

        } catch(Throwable $exception) {
            dd($exception->getMessage());
        }
    }

    public function updateEntity() {
        $this->clinicalTrial->update($this->getDataAttributes());
        $this->clinicalTrial->refresh();

        $this->matchConditionRelationships();
        $this->matchInterventionRelationships();
        $this->matchLeadSponsor();
        $this->matchResponsibleParty();
        $this->matchCollaborators();
        $this->maskingInfo();
        $this->getArmsGroups();
        $this->getAgeGroups();

//        try {
//            $this->clinicalTrial->update($this->getDataAttributes());
//            $this->clinicalTrial->refresh();
//
//            $this->matchConditionRelationships();
//            $this->matchInterventionRelationships();
//            $this->matchLeadSponsor();
//            $this->matchResponsibleParty();
//            $this->matchCollaborators();
//            $this->maskingInfo();
//            $this->getArmsGroups();
//            $this->getAgeGroups();
//
//            // TODO: contactsLocationsModule has contact info for who to contact if recrutiing/need info
//
//        } catch(Throwable $exception) {
//            dd($exception->getMessage());
//        }
    }

    private function getDataAttributes(): array
    {
        $attributes = [
            'title' => $this->importedEntity->data['protocolSection']['identificationModule']['briefTitle'],
            'official_title' => $this->importedEntity->data['protocolSection']['identificationModule']['officialTitle'],
            'nct_number' => $this->importedEntity->name,
            'status' => Clinicaltrial::STATUSES[$this->importedEntity->data['protocolSection']['statusModule']['overallStatus']],
            'last_update_posted' => Carbon::parse($this->importedEntity->data['protocolSection']['statusModule']['lastUpdateSubmitDate'])->format('Y-m-d'),
            'has_results' => $this->importedEntity->data['hasResults'],
            'other_ids' => $this->importedEntity->data['protocolSection']['identificationModule']['orgStudyIdInfo']['id'],
            'study_url' => 'https://clinicaltrials.gov/study/' . $this->importedEntity->name
        ];

        $attributes['study_results'] = ($this->importedEntity->data['hasResults'] === 1) ? 'Has Results' : 'No Results Available';

        if (array_key_exists('startDateStruct', $this->importedEntity->data['protocolSection']['statusModule'])) {
            $attributes['start_date'] = Carbon::parse($this->importedEntity->data['protocolSection']['statusModule']['startDateStruct']['date'])->format('Y-m-d');
            $attributes['start_date_type'] = $this->getField('type', $this->importedEntity->data['protocolSection']['statusModule']['startDateStruct']);
        }

        if (array_key_exists('primaryCompletionDateStruct', $this->importedEntity->data['protocolSection']['statusModule'])) {
            $attributes['primary_completion_date'] = Carbon::parse($this->importedEntity->data['protocolSection']['statusModule']['primaryCompletionDateStruct']['date'])->format('Y-m-d');
            $attributes['primary_completion_date_type'] = $this->getField('type', $this->importedEntity->data['protocolSection']['statusModule']['primaryCompletionDateStruct']);
        }

        if (array_key_exists('completionDateStruct', $this->importedEntity->data['protocolSection']['statusModule'])) {
            $attributes['completion_date'] = Carbon::parse($this->importedEntity->data['protocolSection']['statusModule']['completionDateStruct']['date'])->format('Y-m-d');
            $attributes['completion_date_type'] = $this->getField('type', $this->importedEntity->data['protocolSection']['statusModule']['completionDateStruct']);
        }

        if (array_key_exists('studyFirstPostDateStruct', $this->importedEntity->data['protocolSection']['statusModule'])) {
            $attributes['first_posted'] = Carbon::parse($this->importedEntity->data['protocolSection']['statusModule']['studyFirstPostDateStruct']['date'])->format('Y-m-d');
            $attributes['first_posted_type'] = $this->getField('type', $this->importedEntity->data['protocolSection']['statusModule']['studyFirstPostDateStruct']);
        }

        if (array_key_exists('resultsFirstPostDateStruct', $this->importedEntity->data['protocolSection']['statusModule'])) {
            $attributes['results_first_posted'] = Carbon::parse($this->importedEntity->data['protocolSection']['statusModule']['resultsFirstPostDateStruct']['date'])->format('Y-m-d');
            $attributes['results_first_posted_type'] = $this->getField('type', $this->importedEntity->data['protocolSection']['statusModule']['resultsFirstPostDateStruct']);
        }

        $attributes['healthy_volunteers'] = ($this->getField('healthyVolunteers', $this->importedEntity->data['protocolSection']['eligibilityModule']) !== NULL) ?? 0;
        $attributes['eligibility_criteria'] = nl2br($this->getField('eligibilityCriteria', $this->importedEntity->data['protocolSection']['eligibilityModule']));

        $attributes['brief_summary'] = $this->getField('briefSummary', $this->importedEntity->data['protocolSection']['descriptionModule']);
        $attributes['detailed_description'] = nl2br($this->getField('detailedDescription', $this->importedEntity->data['protocolSection']['descriptionModule']));

        $attributes['study_type'] = $this->getField('studyType', $this->importedEntity->data['protocolSection']['designModule']);

        $attributes['enrollment'] = $this->getField('count', $this->importedEntity->data['protocolSection']['designModule']['enrollmentInfo']);
        $attributes['enrollment_type'] = $this->getField('type', $this->importedEntity->data['protocolSection']['designModule']['enrollmentInfo']);

        $attributes['gender'] = Clinicaltrial::SEXES[$this->getField('sex', $this->importedEntity->data['protocolSection']['eligibilityModule'])];

        $attributes['allocation'] = $this->matchConst('allocation', $this->getField('allocation', $this->importedEntity->data['protocolSection']['designModule']['designInfo']));
        $attributes['primary_purpose'] = $this->matchConst('primary_purpose', $this->getField('primaryPurpose', $this->importedEntity->data['protocolSection']['designModule']['designInfo']));
        $attributes['time_perspective'] = $this->matchConst('time_perspective', $this->getField('timePerspective', $this->importedEntity->data['protocolSection']['designModule']['designInfo']));
        $attributes['observational_model'] = $this->matchConst('observational_model', $this->getField('observationalModel', $this->importedEntity->data['protocolSection']['designModule']['designInfo']));

        $attributes['intervention_model_description'] = $this->getField('interventionModelDescription', $this->importedEntity->data['protocolSection']['designModule']['designInfo']);

        $attributes['min_age'] = $this->getAgeField('minimumAge', $this->importedEntity->data['protocolSection']['eligibilityModule']);
        $attributes['max_age'] = $this->getAgeField('maximumAge', $this->importedEntity->data['protocolSection']['eligibilityModule']);

        if (($attributes['min_age'] !== NULL) AND ($attributes['max_age'] !== NULL)) {
            $attributes['age'] = $this->importedEntity->data['protocolSection']['eligibilityModule']['minimumAge'] . ' to ' .
                $this->importedEntity->data['protocolSection']['eligibilityModule']['maximumAge'];
        }

        if (array_key_exists('primaryOutcomes', $this->importedEntity->data['protocolSection']['outcomesModule'])) {
            $attributes['primary_outcomes'] = $this->importedEntity->data['protocolSection']['outcomesModule']['primaryOutcomes'];
        }

        if (array_key_exists('secondaryOutcomes', $this->importedEntity->data['protocolSection']['outcomesModule'])) {
            $attributes['secondary_outcomes'] = $this->importedEntity->data['protocolSection']['outcomesModule']['secondaryOutcomes'];
        }

        if (array_key_exists('otherOutcomes', $this->importedEntity->data['protocolSection']['outcomesModule'])) {
            $attributes['other_outcomes'] = $this->importedEntity->data['protocolSection']['outcomesModule']['otherOutcomes'];
        }

        return $attributes;
    }

    private function getArmsGroups() {
        if (array_key_exists('armGroups', $this->importedEntity->data['protocolSection']['armsInterventionsModule'])) {
            $armGroups = $this->importedEntity->data['protocolSection']['armsInterventionsModule']['armGroups'];
            $prettyGroups = [];

            foreach($armGroups as $armGroup) {
                $prettyGroup = [];

                foreach ($armGroup as $key => $value) {
                    if ($key === 'type') {
                        $newValue = Clinicaltrial::ARM_GROUP_TYPES[$value];
                    } else {
                        $newValue = $value;
                    }

                    $prettyGroup[$key] = $newValue;
                }

                $prettyGroups[] = $prettyGroup;
            }

            $this->clinicalTrial->arm_groups = $prettyGroups;
            $this->clinicalTrial->save();
        }
    }

    private function getAgeGroups() {
        if (array_key_exists('stdAges', $this->importedEntity->data['protocolSection']['eligibilityModule'])) {
            $ageGroups = $this->importedEntity->data['protocolSection']['eligibilityModule']['stdAges'];
            $prettyAgeGroups = [];

            foreach($ageGroups as $value) {
                $newValue = Clinicaltrial::STANDARD_AGES[$value];
                $prettyAgeGroups[] = $newValue;
            }

            $this->clinicalTrial->age_groups = $prettyAgeGroups;
            $this->clinicalTrial->save();
        }
    }

    private function matchConst($fieldName, $value): ?string
    {
        if ($value === NULL) {
            return NULL;
        }

        $valueArray = match($fieldName) {
            'primary_purpose' => Clinicaltrial::PRIMARY_PURPOSES,
            'allocation' => Clinicaltrial::DESIGN_ALLOCATIONS,
            'intervention_model' => Clinicaltrial::INTERVENTIONAL_ASSIGNMENTS,
            'time_perspective' => Clinicaltrial::DESIGN_TIME_PERSPECTIVE,
            'observational_model' => Clinicaltrial::OBSERVATIONAL_MODELS
        };

        return $valueArray[$value];
    }

    private function getField($field, $parent) {
        if (array_key_exists($field, $parent)) {
            return $parent[$field];
        }

        return NULL;
    }

    private function getAgeField($field, $parent): ?string
    {
        if (array_key_exists($field, $parent)) {
            return str_replace(' Years', '', $parent[$field]);
        }

        return NULL;
    }

    private function matchConditionRelationships() {
        $items = $this->importedEntity->data['protocolSection']['conditionsModule']['conditions'];
        $recordIds = [];

        foreach ($items as $item) {
            $attributes = [
                'value' => $item
            ];

            $condition = CtCondition::updateOrCreate($attributes, $attributes);
            $recordIds[] = $condition->id;
        }

        $this->clinicalTrial->conditions()->sync($recordIds);
    }

    private function matchInterventionRelationships() {
        $items = $this->importedEntity->data['protocolSection']['armsInterventionsModule']['interventions'];
        $recordsWithPivots = [];

        foreach ($items as $item) {
            $attributes = [
                'value' => $item['name']
            ];

            $focus = Focus::where('name', $item['name'])->first();
            if ($focus) {
                $this->clinicalTrial->focus()->syncWithoutDetaching($focus->id);
            }

            $intervention = CtIntervention::updateOrCreate($attributes, $attributes);

            if (array_key_exists('description', $item)) {
                $description = $item['description'];
            } else {
                $description = "N/A";
            }

            $recordsWithPivots[$intervention->id] = [
                'type' => $item['type'],
                'description' => $description
            ];
        }

        $this->clinicalTrial->interventions()->sync($recordsWithPivots);
    }

    private function matchPhaseRelationships() {
        // TODO: not finished
        $items = $this->importedEntity->data['protocolSection']['designModule']['phases'];
        $recordIds = [];

        foreach ($items as $item) {
            $attributes = [
                'name' => $item
            ];

            $condition = ClinicaltrialPhase::updateOrCreate($attributes, $attributes);
            $recordIds[] = $condition->id;
        }

        $this->clinicalTrial->conditions()->sync($recordIds);
    }

    private function matchResponsibleParty() {

        if ($this->clinicalTrial->responsible_party_id AND $this->clinicalTrial->responsible_party_type) {
            return;
        }

        if (!array_key_exists('responsibleParty', $this->importedEntity->data['protocolSection']['sponsorCollaboratorsModule'])) {
            $this->clinicalTrial->responsible_party_notes = "No responsible party listed";
            $this->clinicalTrial->save();
            return;
        }

        $responsiblePartyType = $this->importedEntity->data['protocolSection']['sponsorCollaboratorsModule']['responsibleParty']['type'];

        if ($responsiblePartyType === 'SPONSOR') {
            $this->clinicalTrial->lead_sponsor_notes = 'Lead sponsor is responsible party';
        } else {
            $responsiblePartyInvestigatorTitle = $this->importedEntity->data['protocolSection']['sponsorCollaboratorsModule']['responsibleParty']['investigatorTitle'];
            $responsiblePartyInvestigatorFullName = $this->importedEntity->data['protocolSection']['sponsorCollaboratorsModule']['responsibleParty']['investigatorFullName'];
            $responsibleInvestigatorAffiliation = $this->importedEntity->data['protocolSection']['sponsorCollaboratorsModule']['responsibleParty']['investigatorAffiliation'];

            $person = Person::where('name', $responsiblePartyInvestigatorFullName)->first();

            if ($person) {
                // TODO: Don't create new org?!
                $responsiblePartyOrg = Company::updateOrCreate(
                    ['name' => $responsibleInvestigatorAffiliation],
                    ['name' => $responsibleInvestigatorAffiliation]
                );

                $person->companies()->syncWithPivotValues([$responsiblePartyOrg->id], ['position' => $responsiblePartyInvestigatorTitle]);

                $this->clinicalTrial->responsible_party_id = $person->id;
                $this->clinicalTrial->responsible_party_type = Person::class;
            } else {
                // TODO: Need to throw error on the import entity that we have to manually add this person
                $errors = $this->importedEntity->errors;

                $errors[ImportedEntity::ERROR_RESPONSIBLE_PARTY] = 'No match for ' . $responsiblePartyInvestigatorFullName .
                    ' (' . $responsiblePartyInvestigatorTitle . ' at ' . $responsibleInvestigatorAffiliation .  ')';
                $this->importedEntity->errors = $errors;
                $this->importedEntity->save();
            }
        }

        $this->clinicalTrial->save();
    }

    private function matchCollaborators() {
        if (array_key_exists('collaborators', $this->importedEntity->data['protocolSection']['sponsorCollaboratorsModule'])) {
            $collaborators = $this->importedEntity->data['protocolSection']['sponsorCollaboratorsModule']['collaborators'];

            $collaboratorIds = [];

            foreach($collaborators as $collaborator) {
                $company = Company::updateOrCreate(
                    ['name' => $collaborator['name']],
                    ['name' => $collaborator['name']]
                );

                $collaboratorIds[] = $company->id;
            }

            $this->clinicalTrial->collaborators()->syncWithPivotValues($collaboratorIds, ['type' => Clinicaltrial::COLLABORATOR]);
        }
    }

    private function matchLeadSponsor() {

        if ($this->clinicalTrial->lead_sponsor_type AND $this->clinicalTrial->lead_sponsor_id) {
            return;
        }

        $leadSponsorName = $this->importedEntity->data['protocolSection']['sponsorCollaboratorsModule']['leadSponsor']['name'];
        $agencyClass = $this->importedEntity->data['protocolSection']['sponsorCollaboratorsModule']['leadSponsor']['class'];

        $companyMatch = Company::where('name', $leadSponsorName)->first();

        if ($companyMatch) {
            $this->clinicalTrial->lead_sponsor_id = $companyMatch->id;
            $this->clinicalTrial->lead_sponsor_type = Company::class;

            return;
        }

        $personMatch = Person::where('name', $leadSponsorName)->first();

        if ($personMatch) {
            $this->clinicalTrial->lead_sponsor_id = $personMatch->id;
            $this->clinicalTrial->lead_sponsor_type = Person::class;

            return;
        }

        $errors = $this->importedEntity->errors;

        $errors[ImportedEntity::ERROR_LEAD_SPONSOR] = 'No match for ' . $leadSponsorName .  ' (' . $agencyClass . ')';
        $this->importedEntity->errors = $errors;
        $this->importedEntity->save();
    }

    private function maskingInfo() {
        if (!array_key_exists('maskingInfo', $this->importedEntity->data['protocolSection']['designModule']['designInfo'])) {
            return;
        }

        $this->clinicalTrial->masking = $this->getField('masking', $this->importedEntity->data['protocolSection']['designModule']['designInfo']['maskingInfo']);
        $this->clinicalTrial->masking_description = $this->getField('maskingDescription', $this->importedEntity->data['protocolSection']['designModule']['designInfo']['maskingInfo']);

        if (array_key_exists('whoMasked', $this->importedEntity->data['protocolSection']['designModule']['designInfo']['maskingInfo'])) {
            $whoMaskedArray = $this->importedEntity->data['protocolSection']['designModule']['designInfo']['maskingInfo']['whoMasked'];
            $prettyMaskedArray = [];

            foreach($whoMaskedArray as $item) {
                $prettyMaskedArray[] = Clinicaltrial::WHO_MASKED[$item];
            }
            $this->clinicalTrial->who_masked = $prettyMaskedArray;
        }

        $this->clinicalTrial->save();
    }

    public function render()
    {
        return view('livewire.admin.import.clinical-trials.match-entity');
    }
}
