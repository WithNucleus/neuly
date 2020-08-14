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

        $pivot = [
            'email_notification' => '',
            'app_notification' => ''
        ];

        if($entity !== null)
        {
            $entity->followers()->attach($user, $pivot);
        }
        else
        {
            $request->session()->flash('There was a problem with following, please try again later.');
        }

        return redirect(url()->previous());
    }
}
