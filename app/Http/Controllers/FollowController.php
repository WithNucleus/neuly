<?php

namespace App\Http\Controllers;

use App\Traits\GetEntityToFollow;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class FollowController extends Controller
{
    use GetEntityToFollow;

    public function add(Request $request, String $entity, Int $id)
    {
        $data = [
          'entity' => $entity,
          'id' => $id,
        ];
        return view('members.follow.add', $data);
    }

    public function store(Request $request, String $entity, Int $id)
    {
        $user = auth()->user();
        $entity = $this->getEntity($entity, $id);

        if ($request->input('email_notification') === null AND $request->input('app_notification') === null)
        {
            $request->session()->flash('error', 'You have to choose an alert option to follow this...');
            return redirect(url()->previous());
        }

        $pivot = [
            'email_notification' => $request->input('email_notification') ? $request->input('email_notification') : 0,
            'app_notification' => $request->input('app_notification') ? $request->input('app_notification') : 0
        ];

        if($entity !== null)
        {
            $entity->followers()->attach($user, $pivot);
        }
        else
        {
            $request->session()->flash('error', 'There was a problem with following, please try again later.');
        }

        $request->session()->flash('success', 'Congrats - you\'re now following {entity_name}!');
        return redirect(url()->previous());
    }
}
