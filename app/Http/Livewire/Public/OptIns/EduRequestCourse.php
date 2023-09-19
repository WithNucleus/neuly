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

    public $name;
    public $email;
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
            $this->name = $user->full_name;
            $this->email = $user->email;
        }
    }

    public function rules() {
        return [
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'nullable',
        ];
    }

    public function submit() {
        $this->validate();

        EduRequest::create([
            'name' => $this->name,
            'email' => $this->email,
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
