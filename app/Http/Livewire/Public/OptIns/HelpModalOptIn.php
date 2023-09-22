<?php

namespace App\Http\Livewire\Public\OptIns;

use App\Http\Livewire\Public\Traits\LocalLocationFilter;
use App\Models\Feedback;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class HelpModalOptIn extends Component
{
    use LocalLocationFilter;

    public string $url;
    public string $ip;
    public ?int $userId = null;
    public array $localLocation = [
        'latitude' => null,
        'longitude' => null,
        'name' => null,
        'id' => null
    ];

    public ?string $type = null;
    public ?string $subject = null;
    public ?string $first_name = null;
    public ?string $last_name = null;
    public ?string $email = null;
    public ?string $phone = null;
    public ?string $message = null;

    public bool $success = false;

    public function mount(Request $request) {
        $this->ip = $request->getClientIp();
        $this->url = url()->current();

        $this->type = Feedback::TYPE_FEEDBACK;

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
            'subject' => 'required',
            'type' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'message' => 'required',
            'phone' => 'nullable',
        ];
    }

    public function submit() {
        $this->validate();

        Feedback::create([
            'title' => $this->subject,
            'type' => $this->type,
            'user_name' => $this->first_name . ' ' . $this->last_name,
            'user_email' => $this->email,
            'user_id' => $this->userId,
            'url' => $this->url,
            'content' => $this->message,
            'data' => [
                'locations' => [
                    'local' => $this->localLocation
                ],
                'ip' => $this->ip,
                'phone' => $this->phone
            ]
        ]);

        $this->success = true;
    }

    public function render()
    {
        return view('livewire.public.opt-ins.help-modal-opt-in', [
            'typeOptions' => Feedback::TYPE_NICE_NAMES
        ]);
    }
}
