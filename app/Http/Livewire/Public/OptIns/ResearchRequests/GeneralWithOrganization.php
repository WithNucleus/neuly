<?php

namespace App\Http\Livewire\Public\OptIns\ResearchRequests;

use App\Http\Livewire\Public\Traits\LocalLocationFilter;
use App\Models\ResearchRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class GeneralWithOrganization extends Component
{
    use LocalLocationFilter;

    public string $requestType;
    public ?string $titleMessage;
    public ?string $titleClasses;
    public ?string $messageLabel;
    public bool $showSuccessActions = false;

    public $first_name;
    public $last_name;
    public $email;
    public $phone;
    public $organization;
    public $website;
    public $message;

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
            'organization' => 'required',
            'website' => 'required',
            'message' => 'required',
        ];
    }

    public function submit() {
        $this->validate();

        ResearchRequest::create([
            'name' => $this->first_name . ' ' . $this->last_name,
            'email' => $this->email,
            'phone' => $this->phone,
            'type' => $this->requestType,
            'status' => ResearchRequest::STATUS_OPEN,
            'message' => $this->message,
            'data' => [
                'locations' => [
                    'local' => $this->localLocation,
                ],
                'organization' => $this->organization,
                'website' => $this->website
            ],
            'user_id' => $this->userId,
            'ip' => $this->ip,
        ]);

        $this->success = true;
    }

    public function render()
    {
        return view('livewire.public.opt-ins.research-requests.general-with-organization');
    }
}
