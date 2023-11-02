<?php

namespace App\Imports\Users;

use App\Models\EmailJourney;
use App\Models\EmailPreference;
use App\Models\ImportResult;
use App\Models\UserInvitation;
use App\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Throwable;

class InviteUsersImport implements ToCollection, WithHeadingRow, WithChunkReading
{
    private $journey;
    private $inviterId;

    public function __construct(string $journey, int $inviterId) {
        $this->journey = $journey;
        $this->inviterId = $inviterId;
    }

    public function collection(Collection $collection)
    {
        $importResult = ImportResult::create([
            'type' => ImportResult::TYPE_USER_INVITES,
            'user_id' => Auth::id(),
            'rows' => count($collection),
            'data' => $collection,
            'entity' => EmailPreference::class
        ]);

        $allowedJourneys = EmailJourney::JOURNEYS_WITH_AUTOMATION;
        $emailJourney = NULL;

        if (in_array($this->journey, $allowedJourneys)) {
            $importResult->notes = 'Journey: ' . $this->journey;
            $importResult->save();
            $emailJourneyRecord = EmailJourney::where('name', $this->journey)->firstOrFail();
            $emailJourney = $emailJourneyRecord->id;
        }

        $exceptions = [];
        $existingUsers = [];

        foreach($collection as $row) {

            $existingUser = User::where('email', $row['email'])->first();

            if ($existingUser) {
                $existingUsers[$existingUser->id] = $row['email'];
            } else {
                try {
                    $attributes = [
                        'email' => trim($row['email']),
                        'first_name' => trim($row['first_name']) ?? NULL,
                        'last_name' => trim($row['last_name']) ?? NULL,
                        'source' => $row['source'] ?? NULL
                    ];

                    $emailPreference = EmailPreference::updateOrCreate(['email' => $row['email']], $attributes);

                    UserInvitation::create([
                        'inviter_id' => $this->inviterId,
                        'email_preference_email' => $emailPreference->id,
                        'email_journey_id' => $emailJourney,
                        'token' => UserInvitation::generateToken()
                    ]);

                } catch (Throwable $exception) {
                    $exceptions[$row['email']] = $exception->getMessage();
                }
            }
        }

        if (empty($exceptions) AND empty($existingUsers)) {
            $importResult->status = ImportResult::STATUS_SUCCESS;
        } else {
            $errors = [];

            if (!empty($exceptions)) {
                $errors['Exceptions'] = $exceptions;
            }

            if (!empty($existingUsers)) {
                $errors['Existing Users'] = $existingUsers;
            }

            $importResult->errors = $errors;
            $importResult->status = ImportResult::STATUS_SUCCESS_WITH_ERRORS;
        }

        $importResult->save();
    }

    public function uniqueBy(): array
    {
        return ['email'];
    }

    public function chunkSize(): int
    {
        return 500;
    }
}
