<?php

namespace App\Http\Controllers\Admin\Import\ClinicalTrial;

use App\Models\Clinicaltrial;
use App\Models\ClinicaltrialParsingResult;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Illuminate\Http\Request;
use Prologue\Alerts\Facades\Alert;

class ParsingResultsController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation {
        update as traitUpdate;
    }
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;

    public function setup()
    {
        $this->crud->setModel(ClinicaltrialParsingResult::class);
        $this->crud->setRoute(config('backpack.base.route_prefix', 'admin').'/import/clinicaltrial/parsing-results');
        $this->crud->setEntityNameStrings('Clinical Trial parsing - result', 'Clinical Trial parsing - results');
    }

    public function setupListOperation()
    {
        $this->crud->addColumn([
            'name' => 'clinicaltrial',
            'type' => 'relationship',
            'label' => 'NCT',
            'key' => 'nct_number',
            'attribute' => 'nct_number',
        ]);

        $this->crud->addColumn([
            'name' => 'clinicaltrial',
            'type' => 'relationship',
            'label' => 'Title',
            'key' => 'title',
            'attribute' => 'title',
        ]);

        $this->crud->addColumn([
            'name' => 'brief_summary',
            'type' => 'text',
            'priority' => 2,
        ]);

        $this->crud->addColumn([
            'name' => 'detailed_description',
            'type' => 'text',
            'priority' => 2,
        ]);

        $this->crud->allowAccess('approve');
        $this->crud->addButtonFromView('line', 'approve', 'import.clinicaltrial.approve_result', 'beginning');
    }

    public function setupUpdateOperation()
    {
        $this->crud->addField([
            'name' => 'brief_summary',
            'type' => 'textarea',
            'attributes' => [
                'rows' => '8',
                'required' => true,
            ],
        ]);

        $this->crud->addField([
            'name' => 'detailed_description',
            'type' => 'textarea',
            'attributes' => [
                'rows' => '8',
                'required' => true,
            ],
        ]);

        $this->crud->addSaveAction([
            'name' => 'save_and_approve',
            'button_text' => 'Save and approve',
            'order' => 1, // change the order save actions are in
        ]);
    }

    /**
     * @param  int  $id
     * @return \Backpack\CRUD\app\Http\Controllers\Operations\Response|\Illuminate\Http\RedirectResponse
     *
     * @throws \Exception
     */
    public function update(Request $request, $id)
    {
        $response = $this->traitUpdate();

        if ($request->input('save_action') === 'save_and_approve') {
            $this->approveParsedData($this->crud->entry);

            return redirect()->route('admin.import.clinicaltrial.parsing-results.index');
        }

        return $response;
    }

    /**
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Exception
     */
    public function approve($id)
    {
        $parsingResult = ClinicaltrialParsingResult::findOrFail($id);

        $this->approveParsedData($parsingResult);

        return redirect()->route('admin.import.clinicaltrial.parsing-results.index');
    }

    /**
     * @return bool
     *
     * @throws \Exception
     */
    private function approveParsedData(ClinicaltrialParsingResult $parsingResult)
    {
        if (! $parsingResult->brief_summary || ! $parsingResult->detailed_description) {
            Alert::error('Not all data filled for approve!')->flash();

            return false;
        }

        $clinicalTrial = Clinicaltrial::findOrFail($parsingResult->clinicaltrial_id);
        $clinicalTrial->brief_summary = $parsingResult->brief_summary;
        $clinicalTrial->detailed_description = $parsingResult->detailed_description;
        $clinicalTrial->save();

        $parsingResult->delete();

        Alert::success('Clinical trial parsing result was approved!')->flash();

        return true;
    }
}
