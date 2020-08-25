<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\FollowRequest;
use App\Models\Clinicaltrial;
use App\Models\Company;
use App\Models\Event;
use App\Models\Focus;
use App\Models\Follow;
use App\Models\Investor;
use App\Models\Location;
use App\Models\Person;
use App\Models\Research;
use Illuminate\Http\Request;
use Auth;

class FollowController extends Controller
{
    public function index()
    {
        $follows = Follow::with('followable')
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('members.follow.index', compact('follows'));
    }

    public function show($id)
    {
        $follow = Follow::with('followable')
            ->where('user_id', Auth::id())
            ->findOrFail($id);

        $routeName = $this->getFollowableShowRouteName($follow->followable_type);

        return redirect()->route($routeName, $follow->followable->slug);
    }

    public function edit($id)
    {
        $follow      = Follow::with('followable')
            ->where('user_id', Auth::id())
            ->findOrFail($id);
        $previousUrl = url()->previous();

        return view('members.follow.edit', compact('follow', 'previousUrl'));
    }

    /**
     * @param \App\Http\Requests\FollowRequest $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(FollowRequest $request, $id)
    {
        $follow = Follow::with('followable')
            ->where('user_id', Auth::id())
            ->findOrFail($id);

        $follow->app_notification   = $request->input('app_notification', 0);
        $follow->email_notification = $request->input('email_notification', 0);
        $follow->save();

        $name        = $follow->followable->name ? $follow->followable->name : $follow->followable->title;
        $redirectUrl = $request->input('previous_url', url()->previous());

        return redirect($redirectUrl)
            ->with('success', '"' . $name . '" subscription was updated.');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Request $request, $id)
    {
        $follow = Follow::with('followable')
            ->where('user_id', Auth::id())
            ->findOrFail($id);

        $name        = $follow->followable->name ? $follow->followable->name : $follow->followable->title;
        $redirectUrl = $request->input('previous_url', url()->previous());

        $follow->delete();

        return redirect($redirectUrl)
            ->with('success', '"' . $name . '" was deleted from your follows list.');
    }

    /**
     * @param string $followableType
     * @return string|\Symfony\Component\HttpKernel\Exception\HttpException
     */
    private function getFollowableShowRouteName($followableType)
    {
        switch ($followableType) {
            case Clinicaltrial::class:
                $routeName = 'clinicaltrials';
                break;
            case Company::class:
                $routeName = 'organizations';
                break;
            case Event::class:
                $routeName = 'events';
                break;
            case Focus::class:
                $routeName = 'focus';
                break;
            case Investor::class:
                $routeName = 'investors';
                break;
            case Location::class:
                $routeName = 'locations';
                break;
            case Person::class:
                $routeName = 'people';
                break;
            case Research::class:
                $routeName = 'research';
                break;
            default:
                $routeName = null;
                break;
        }

        if ($routeName) {
            return 'discover.' . $routeName . '.show';
        }

        abort(404);
    }
}
