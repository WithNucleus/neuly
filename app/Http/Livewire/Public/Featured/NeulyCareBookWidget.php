<?php

namespace App\Http\Livewire\Public\Featured;

use App\Models\BookableListing;
use App\Models\CareRequest;
use App\Models\SearchLog;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class NeulyCareBookWidget extends Component
{
    public BookableListing $bookableListing;

    public bool $success = false;
    public string $ip;
    public ?int $userId = null;

    public $first_name;
    public $last_name;
    public $email;
    public $phone;
    public $date;
    public $number_of_guests = 1;
    public $message;

    public function rules() {
        return [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'phone' => 'nullable',
            'date' => 'nullable|date',
            'number_of_guests'  => 'nullable|int',
            'message' => 'required',
        ];
    }

    public function mount(Request $request) {
        $this->ip = $request->getClientIp();

        if (Auth::id()) {
            $user = User::findOrFail(Auth::id());
            $this->userId = $user->id;
            $this->first_name = $user->name;
            $this->last_name = $user->last_name;
            $this->email = $user->email;
        }
    }

    public function submit() {
        $this->validate();

        CareRequest::create([
            'name' => $this->first_name . ' ' . $this->last_name,
            'email' => $this->email,
            'phone' => $this->phone,
            'type' => CareRequest::TYPE_BOOKABLE_LISTING_RESERVATION,
            'status' => CareRequest::STATUS_OPEN,
            'message' => $this->message,
            'data' => [
                'number_of_guests' => $this->number_of_guests,
                'date' => $this->date
            ],
            'user_id' => $this->userId,
            'ip' => $this->ip,
            'entity_type' => BookableListing::class,
            'entity_id' => $this->bookableListing->id
        ]);

        $this->success = "Great! We've received your info and will be in touch soon.";
    }

    public function render()
    {
        return view('livewire.public.featured.neuly-care-book-widget');
    }
}
