<?php

namespace App\Http\Controllers\Index;

use App\Helpers\EntityHelper;
use App\Models\Company;
use App\Models\Event;
use App\Models\Focus;
use App\Models\Investor;
use App\Models\Job;
use App\Models\ListingRequest;
use App\Models\Person;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Auth;
use Carbon\Carbon;

class ListingRequestController extends Controller
{
    public function index()
    {
        return view('discover.listing-requests.index');
    }

    public function request()
    {
        $entityTypes = EntityHelper::getListingRequestEntities();

        return view('discover.listing-requests.request', [
            'entityTypes' => $entityTypes
        ]);
    }

    public function submitRequest(Request $request)
    {
        $type = $request->input('general_type');
        $entityTypes = EntityHelper::getListingRequestEntities();

        if (isset($entityTypes[$type]) === false) {
            return redirect()->back()->with('error', 'Wrong entity type!');
        }

        $general = [
            'update' => $request->input('general_update'),
            'name' => $request->input('general_name'),
            'mail' => $request->input('general_mail'),
            'type' => $request->input('general_type')
        ];
        $focusCategories = Focus::orderBy('name')->get();
        $companies = Company::orderBy('name')->get();

        return view('discover.listing-requests.entity', [
            'general'         => $general,
            'focusCategories' => $focusCategories,
            'companies'       => $companies,
        ]);
    }

    public function finishRequest(Request $request)
    {
        $data = $request->all();
        $type = $data['general_type'];
        $entityTypes = EntityHelper::getListingRequestEntities();

        if (isset($entityTypes[$type]) === false) {
            return redirect()->back()->with('error', 'Wrong entity type!');
        }

        $requestEntityClass = $entityTypes[$type];
        $isUpdate = (bool)$data['general_update'];
        $toUpdateId = null;

        if ($isUpdate) {
            $entityToUpdate = $this->getEntityToUpdate($requestEntityClass, $data['entity_update_resource']);
            $toUpdateId     = $entityToUpdate ? $entityToUpdate->id : null;
        }

        if (!isset($data['entity_focus'])) {
            $data['entity_focus'] = [];
        }

        $listingRequest = new ListingRequest();
        $listingRequest->name = $data['general_name'];
        $listingRequest->email = $data['general_mail'];
        $listingRequest->comment = $data['general_comment'];
        $listingRequest->type = $type;
        $listingRequest->entity_name = $this->getEntityNameValue($requestEntityClass, $data);
        $listingRequest->entity_data = $this->createDummyEntityData($requestEntityClass, $data);
        $listingRequest->is_update = $isUpdate;
        $listingRequest->to_update_id = $toUpdateId;
        $listingRequest->save();

        $additionalEntitiesRequested = [];

        if (isset($data['entity_company_new'])) {
            $additionalEntitiesRequested['company'] = $data['entity_company_new'];
        }

        return view('discover.listing-requests.finish', [
            'additionalEntitiesRequested' => $additionalEntitiesRequested
        ]);
    }

    /**
     * @param string $entityClass
     * @param string $searchValue
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    private function getEntityToUpdate($entityClass, $searchValue)
    {
        if ($entityClass === Job::class) {
            return $entityClass::where('job_title', $searchValue)->first();
        }

        return $entityClass::where('name', $searchValue)->first();
    }

    /**
     * @param string $entityClass
     * @param array $entityData
     * @return string
     */
    private function getEntityNameValue($entityClass, $entityData)
    {
        if ($entityClass === Job::class) {
            return $entityData['entity_job_title'];
        }

        return $entityData['entity_name'];
    }

    /**
     * @param string $entityClass
     * @param array $data
     * @return array
     */
    private function createDummyEntityData($entityClass, $data)
    {
        $dummyEntityData = [];

        switch ($entityClass) {
            case Event::class:
                $dummyEntityData = $this->createDummyEvent($data);
                break;
            case Investor::class:
                $dummyEntityData = $this->createDummyInvestor($data);
                break;
            case Job::class:
                $dummyEntityData = $this->createDummyJob($data);
                break;
            case Company::class:
                $dummyEntityData = $this->createDummyCompany($data);
                break;
            case Person::class:
                $dummyEntityData = $this->createDummyPerson($data);
                break;
        }

        return $dummyEntityData;
    }

    private function createDummyCompany($data)
    {
        $logo = isset($data['entity_logo']) ? $this->handleFileUpload($data['entity_logo']) : null;

        return [
            'name' => $data['entity_name'],
            'ownership' => $data['entity_ownership'],
            'website' => $data['entity_website'],
            'summary' => $data['entity_summary'],
            'founded_date' => $data['entity_founded_date'],
            'valuation' => $data['entity_valuation'],
            'number_employees' => $data['entity_number_employees'],
            'ticker_symbol' => $data['entity_ticker_symbol'],
            'total_funding_amount' => $data['entity_total_funding_amount'],
            'last_funding_date' => $data['entity_last_funding_date'],
            'focus_ids' => $data['entity_focus'],
            'logo' => $logo,
        ];
    }

    private function createDummyEvent($data)
    {
        return [
            'name' => $data['entity_name'],
            'website' => $data['entity_website'],
            'registration' => $data['entity_registration'],
            'start' => $data['entity_start'],
            'end' => $data['entity_end'],
            'description' => $data['entity_description'],
            'focus_ids' => $data['entity_focus'],
        ];
    }

    private function createDummyInvestor($data)
    {
        return [
            'name' => $data['entity_name'],
            'website' => $data['entity_website'],
            'type' => $data['entity_type']
        ];
    }

    private function createDummyPerson($data)
    {
        $photo = isset($data['entity_photo']) ? $this->handleFileUpload($data['entity_photo']) : null;

        return [
            'name' => $data['entity_name'],
            'email' => $data['entity_email'],
            'website' => $data['entity_website'],
            'linkedin' => $data['entity_linkedin'],
            'facebook' => $data['entity_facebook'],
            'twitter' => $data['entity_twitter'],
            'bio' => $data['entity_bio'],
            'photo' => $photo,
        ];
    }

    private function createDummyJob($data)
    {
        $dummyData = [
            'job_title' => $data['entity_job_title'],
            'job_description' => $data['entity_job_description'],
            'employment_type' => $data['entity_employment_type'],
            'posted_date' => $data['entity_posted_date'],
            'salary' => $data['entity_salary'],
            'hourly_rate' => $data['entity_hourly_rate'],
            'focus_ids' => $data['entity_focus'],
        ];

        if (isset($data['entity_company'])) {
            $dummyData['company_id'] = $data['entity_company'];
        }

        if (isset($data['entity_company_new'])) {
            $dummyData['company_new'] = $data['entity_company_new'];
        }

        return $dummyData;
    }

    private function handleFileUpload($file)
    {
        $filename = Carbon::now()->format('YmdHis') . '.' . $file->getClientOriginalExtension();

        return Storage::disk('public')->putFileAs('requests', $file, $filename);
    }
}
