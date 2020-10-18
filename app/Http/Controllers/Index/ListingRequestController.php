<?php

namespace App\Http\Controllers\Index;

use App\Models\Company;
use App\Models\Event;
use App\Models\Focus;
use App\Models\Investor;
use App\Models\ListingRequest;
use App\Models\Person;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Auth;
use Illuminate\Support\Str;
use Carbon\Carbon;

class ListingRequestController extends Controller
{
    public function index()
    {
        return view('discover.listing-requests.index');
    }

    public function request()
    {
        return view('discover.listing-requests.request');
    }

    public function entityForm(Request $request)
    {
        $general = [
            'update' => $request->input('general_update'),
            'name' => $request->input('general_name'),
            'mail' => $request->input('general_mail'),
            'type' => $request->input('general_type')
        ];
        $focusCategories = Focus::orderBy('name')->get();

        return view('discover.listing-requests.entity', [
            'general' => $general,
            'focusCategories' => $focusCategories,
        ]);
    }

    public function processData(Request $request)
    {
        $data = $request->all();

        if (!isset($data['entity_focus'])) {
            $data['entity_focus'] = [];
        }

        $entityData = $this->createDummyEntityData($data['general_type'], $data);

        $toUpdateId = null;

        if($this->getBoolValue($data['general_update']))
        {
            $toUpdateId = $this->getUpdatedResourceId($data['general_type'], $data['entity_update_resource']);
        }

        // If Logged-in User Overwrite their Given Info
        if (Auth::user()) {
            $data['general_name'] = Auth::user()->name . ' ' . Auth::user()->last_name;
            $data['general_mail'] = Auth::user()->email;
        }

        $listingRequest = new ListingRequest();
        $listingRequest->name = $data['general_name'];
        $listingRequest->email = $data['general_mail'];
        $listingRequest->is_update = $this->getBoolValue($data['general_update']);
        $listingRequest->type = $data['general_type'];
        $listingRequest->comment = $data['general_comment'];
        $listingRequest->entity_data = $entityData;
        $listingRequest->entity_name = $data['entity_name'];
        $listingRequest->to_update_id = $toUpdateId;
        $listingRequest->save();


        return view('discover.listing-requests.finish');
    }

    private function getBoolValue($value) {
        return ($value === 'true') ? true : false;
    }

    private function getUpdatedResourceId($type, $name)
    {
        return $this->{'get'.$type.'Id'}($name);
    }

    private function getInvestorId($name)
    {
        $investor = Investor::where('name', '=', $name)->first();

        if ($investor) {
            return $investor->id;
        } else {
            return 0;
        }
    }

    private function getPersonId($name)
    {
        $person = Person::where('name', '=', $name)->first();

        if ($person) {
            return $person->id;
        } else {
            return 0;
        }
    }

    private function getEventId($name)
    {
        $event = Event::where('name', '=', $name)->first();

        if ($event) {
            return $event->id;
        } else {
            return 0;
        }
    }

    private function getOrganizationId($name)
    {
        $organisation = Company::where('name', '=', $name)->first();

        if ($organisation) {
            return $organisation->id;
        } else {
            return 0;
        }
    }

    private function createDummyEntityData($type, $data)
    {
        return json_encode($this->{'createDummy'.$type}($data));
    }

    private function createDummyOrganization($data)
    {
        $logo = null;

        if(array_key_exists('entity_logo', $data))
        {
            $filename = 'org-logo-' . Str::slug($data['entity_name']) . Carbon::now()->format('YmdHis') . '.' . $data['entity_logo']->getClientOriginalExtension();
            $logo = $this->handleFileUpload($data['entity_logo'], $filename);
        }

        $resourceData = [
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

        return $resourceData;
    }

    private function createDummyEvent($data)
    {
        $resourceData = [
            'name' => $data['entity_name'],
            'website' => $data['entity_website'],
            'registration' => $data['entity_registration'],
            'start' => $data['entity_start'],
            'end' => $data['entity_end'],
            'description' => $data['entity_description'],
            'focus_ids' => $data['entity_focus'],
        ];

        return $resourceData;
    }

    private function createDummyInvestor($data)
    {
        $resourceData = [
            'name' => $data['entity_name'],
            'website' => $data['entity_website'],
            'type' => $data['entity_type']
        ];

        return $resourceData;
    }

    private function createDummyPerson($data)
    {
        $photo = null;

        if(array_key_exists('entity_photo', $data))
        {
            $filename = 'person-photo-' . Str::slug($data['entity_name']) . '-' . Carbon::now()->format('YmdHis') . '.' . $data['entity_photo']->getClientOriginalExtension();
            $photo = $this->handleFileUpload($data['entity_photo'], $filename);
        }

        $resourceData = [
            'name' => $data['entity_name'],
            'email' => $data['entity_email'],
            'website' => $data['entity_website'],
            'linkedin' => $data['entity_linkedin'],
            'facebook' => $data['entity_facebook'],
            'twitter' => $data['entity_twitter'],
            'bio' => $data['entity_bio'],
            'photo' => $photo,
        ];

        return $resourceData;
    }

    private function handleFileUpload($file, $filename)
    {
        return Storage::disk('public')->putFileAs('requests', $file, $filename);
    }
}
