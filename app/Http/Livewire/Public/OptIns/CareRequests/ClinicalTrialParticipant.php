<?php

namespace App\Http\Livewire\Public\OptIns\CareRequests;

use App\Http\Livewire\Public\Traits\LocalLocationFilter;
use App\Models\CareRequest;
use App\Models\Clinicaltrial;
use App\Models\Course;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ClinicalTrialParticipant extends Component
{
    use LocalLocationFilter;

    public Clinicaltrial $clinicalTrial;

    public $first_name;
    public $last_name;
    public $email;
    public $phone;
    public $message;
    public $age;
    public $sex;

    public bool $success = false;

    public string $ip;
    public ?int $userId = null;
    public array $localLocation = [
        'latitude' => null,
        'longitude' => null,
        'name' => null,
        'id' => null
    ];

    public function mount(Request $request) {
        $this->ip = $request->getClientIp();

        $this->getLocalLocation();

        if (Auth::id()) {
            $user = User::findOrFail(Auth::id());
            $this->userId = $user->id;
            $this->first_name = $user->name;
            $this->last_name = $user->last_name;
            $this->email = $user->email;
        }
    }

    public function rules() {
        return [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'phone' => 'nullable',
            'message' => 'required',
            'age' => 'required',
            'sex' => 'required',
        ];
    }

    public function submit() {
        $this->validate();

        CareRequest::create([
            'name' => $this->first_name . ' ' . $this->last_name,
            'email' => $this->email,
            'phone' => $this->phone,
            'type' => CareRequest::TYPE_CLINICAL_TRIAL_PARTICIPANT,
            'status' => CareRequest::STATUS_OPEN,
            'message' => $this->message,
            'data' => [
                'locations' => [
                    'local' => $this->localLocation,
                ]
            ],
            'user_id' => $this->userId,
            'ip' => $this->ip,
            'entity_type' => Clinicaltrial::class,
            'entity_id' => $this->clinicalTrial->id
        ]);

        $this->success = true;
    }

    public function render()
    {
        return view('livewire.public.opt-ins.care-requests.clinical-trial-participant', [
            'sexOptions' => Clinicaltrial::SEX_OPTIONS
        ]);
    }
}
