<?php

namespace App\Http\Livewire\Public\OptIns;

use App\Http\Livewire\Public\Traits\LocalLocationFilter;
use App\Models\Course;
use App\Models\EduRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class EduRequestCourse extends Component
{
    use LocalLocationFilter;

    public Course $course;

    public $first_name;
    public $last_name;
    public $email;
    public $phone;
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
            'phone' => 'required',
            'message' => 'nullable',
        ];
    }

    public function submit() {
        $this->validate();

        EduRequest::create([
            'name' => $this->first_name . ' ' . $this->last_name,
            'email' => $this->email,
            'phone' => $this->phone,
            'type' => EduRequest::TYPE_COURSE_REQUEST,
            'status' => EduRequest::STATUS_OPEN,
            'message' => $this->message,
            'data' => [
                'locations' => [
                    'local' => $this->localLocation,
                ]
            ],
            'user_id' => $this->userId,
            'ip' => $this->ip,
            'entity_type' => Course::class,
            'entity_id' => $this->course->id
        ]);

        $this->success = true;
    }

    public function render()
    {
        return view('livewire.public.opt-ins.edu-request-course');
    }
}
