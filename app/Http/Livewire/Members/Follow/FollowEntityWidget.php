<?php

namespace App\Http\Livewire\Members\Follow;

use App\Models\Follow;
use App\Models\FollowList;
use App\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Spatie\SlackAlerts\Facades\SlackAlert;
use Throwable;

class FollowEntityWidget extends Component
{
    public bool $showModal;
    public ?string $buttonLabel = null;

    public User $user;
    public $entity;
    public ?bool $isFollowed;

    public ?string $success = null;
    public ?string $error = null;

    public $lists;

    public Follow $follow;

    public bool $addNewList = false;
    public ?string $newListName = null;
    public ?string $newListSuccess = null;
    public ?string $newListError = null;

    protected function rules() {
        return [
            'follow.notes' => 'nullable',
            'follow.follow_list_id' => 'required',
            'follow.email_notification' => 'nullable',
            'follow.app_notification' => 'nullable',
            'follow.user_id' => 'required',
            'follow.followable_type' => 'required',
            'follow.followable_id' => 'required',
        ];
    }

    public function submit() {
        $this->validate();

        try {
            $this->follow->save();
            $this->success = 'Saved!';
            $this->isFollowed = true;

        } catch(Throwable $exception) {
            $this->reset('success');
            $this->error = 'There was a problem. Email help@neuly.com if it continues';

            SlackAlert::to('dev')->blocks([
                [
                    "type" => "section",
                    "text" => [
                    "type" => "mrkdwn",
                        "text" => "<@sydney> Problem during entity follow\n\n```{$exception->getMessage()}```\n\n*Entity:* {$this->entity->name}\n*User:* ({$this->user->id}) {$this->user->fullname}"
                    ],
                ]
            ]);
        }
    }

    private function getUserLists() {
        $this->lists = FollowList::where('user_id', $this->user->id)->get();
    }

    public function mount() {
        $this->user = User::findOrFail(Auth::id());

        $this->getUserLists();

        $this->follow = Follow::where('user_id', $this->user->id)
            ->where('followable_type', get_class($this->entity))
            ->where('followable_id', $this->entity->id)
            ->first() ?? new Follow([
                'user_id' => $this->user->id,
                'followable_type' => get_class($this->entity),
                'followable_id' => $this->entity->id,
                'follow_list_id' => $this->lists->first()->id,
                'email_notification' => 0,
                'app_notification' => 0,
                'notes' => null
            ]);

        $this->isFollowed = (bool) count(Follow::where('user_id', $this->user->id)
            ->where('followable_type', get_class($this->entity))
            ->where('followable_id', $this->entity->id)
            ->get());
    }

    public function addNewList() {
        $this->addNewList = true;
    }

    public function saveNewList() {

        if(FollowList::where('user_id', $this->user->id)->where('name', $this->newListName)->first()) {
            $this->reset('newListSuccess');
            $this->newListError = 'List name is taken';
        } else {
            try {
                FollowList::create([
                   'user_id' => $this->user->id,
                   'name' => $this->newListName
                ]);

                $this->newListSuccess = 'Saved new list!';
                $this->getUserLists();
                $this->reset('newListError');
                $this->reset('addNewList');
                $this->reset('newListName');

            } catch(Throwable $exception) {
                $this->reset('newListSuccess');
                $this->newListError = 'There was an error. Contact help@neuly.com if it continues';

                SlackAlert::to('dev')->blocks([
                    [
                        "type" => "section",
                        "text" => [
                        "type" => "mrkdwn",
                            "text" => "<@sydney> Problem during entity list add\n\n```{$exception->getMessage()}```\n\n*Entity:* {$this->entity->name}\n*User:* ({$this->user->id}) {$this->user->fullname}"
                        ],
                    ]
                ]);
            }
        }
    }

    public function removeFollow() {
        $this->follow->delete();
        $this->isFollowed = false;
        $this->success = 'Unfollowed!';
    }

    public function render()
    {
        return view('livewire.members.follow.follow-entity-widget');
    }
}
