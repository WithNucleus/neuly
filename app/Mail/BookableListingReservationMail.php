<?php

namespace App\Mail;

use App\Models\BookableListingRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BookableListingReservationMail extends Mailable
{
    use Queueable, SerializesModels;

    private BookableListingRequest $bookableListingRequest;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(BookableListingRequest $bookableListingRequest)
    {
        $this->bookableListingRequest = $bookableListingRequest;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $name = $this->bookableListingRequest->first_name . " " . $this->bookableListingRequest->last_name;

        return $this->markdown('emails.bookable-listings.new-request')
            ->with([
                'name' => $name,
                'email' => $this->bookableListingRequest->email,
                'phone' => $this->bookableListingRequest->phone,
                'date' => $this->bookableListingRequest->date,
                'message' => $this->bookableListingRequest->message,
                'bookable' => $this->bookableListingRequest->bookableListing->bookable->name
            ])
            ->subject('Request for ' . $this->bookableListingRequest->bookableListing->bookable->name . ' from ' . $name);
    }
}
