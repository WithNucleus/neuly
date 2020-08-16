<?php

namespace App\Http\Controllers;

use App\Traits\GetEntityToFollow;
use Illuminate\Http\Request;

class UnfollowController extends Controller
{
    use GetEntityToFollow;

    public function add(Request $request, String $entity, Int $id)
    {
        $data = [
            'entity' => $entity,
            'id' => $id,
        ];

        return view('members.unfollow.add', $data);
    }

    public function store(Request $request, String $entity, Int $id)
    {
        $user = auth()->user();
        $entity = $this->getEntity($entity, $id);

        if($entity !== null)
        {
            $entity->followers()->detach($user);
        }
        else
        {
            $request->session()->flash('There was a problem with following, please try again later.');
        }

        return redirect(url()->previous());
    }
}
