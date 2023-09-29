<?php

namespace App\Http\Controllers\Adminx\NavigationTiles;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreNavigationTileRequest;
use App\Models\NavigationTile;
use App\Models\NavigationTileItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class NavigationTileController extends Controller
{
    public function __construct() {
        View::share('currentRoute', 'nav-tiles');
    }

    /**
     * Index listing of all Navigation Tiles
     */
    public function index()
    {
        $navigationTiles = NavigationTile::orderBy('name', 'asc')->get();

        return view('admin.nav-tiles.index', compact('navigationTiles'));
    }

    /**
     * Create a New Navigation Tile
     */
    public function create()
    {
        return view('admin.nav-tiles.create');
    }

    /**
     * Save a newly created Navigation Tile
     */
    public function store(StoreNavigationTileRequest $request): \Illuminate\Http\RedirectResponse
    {
        $attributes = $request->except('_token');
        $navigationTile = NavigationTile::create($attributes);

        return redirect()->route('adminx.nav-tiles.edit', $navigationTile->id)->with('navigationTileSuccess', 'Created the navigation tile for '.$navigationTile->name.'!');
    }

    /**
     * View with form to edit a Navigation Tile & form to add links
     */
    public function edit($id)
    {
        $navigationTile = NavigationTile::with('navItems')->findOrFail($id);

        return view('admin.nav-tiles.edit', compact('navigationTile'));
    }

    /**
     * Updates an existing Navigation Tile
     */
    public function update($id, StoreNavigationTileRequest $request): \Illuminate\Http\RedirectResponse
    {
        $navigationTile = NavigationTile::findOrFail($id);
        $attributes = $request->except('_token');
        $navigationTile->update($attributes);

        return redirect()->route('adminx.nav-tiles.edit', $id)->with('navigationTileSuccess', 'Updated nav tile!');
    }

    public function clone($id): \Illuminate\Http\RedirectResponse
    {
        $oldNavTile = NavigationTile::with('navItems')->findOrFail($id);

        $newNavTile = $oldNavTile->replicate();
        $newNavTile->name = $oldNavTile->name.' '.uniqid();
        $newNavTile->save();

        foreach ($oldNavTile->navItems as $item) {
            $newItem = $item->replicate();
            $newItem->navigation_tile_id = $newNavTile->id;
            $newItem->save();
        }

        return redirect()->route('adminx.nav-tiles.edit', $newNavTile->id)->with('navigationTileSuccess', 'Created cloned navigation tile!');
    }

    /**
     * Deletes a Navigation Tile
     */
    public function delete($id): \Illuminate\Http\JsonResponse
    {
        $response = [
            'status' => 'success',
            'message' => 'Deleted',
        ];

        $navigationTile = NavigationTile::find($id);

        if ($navigationTile) {
            $response['message'] = 'Deleted '.$navigationTile->name;
            $navigationTile->delete();
        } else {
            $response['status'] = 'error';
            $response['message'] = 'There was a problem deleting this...';
        }

        return response()->json($response);
    }

    /**
     * Updates the link order of a Navigation Tile
     */
    public function reorder(Request $request): \Illuminate\Http\JsonResponse
    {
        $items = $request->input('linkOrder');
        $errors = [];

        foreach ($items as $link) {
            $navLink = NavigationTileItem::find($link['link_id']);

            if ($navLink) {
                $navLink->order = $link['order'];
                $navLink->save();
            } else {
                array_push($errors, $link);
            }
        }

        $response = [
            'status' => 'success',
            'message' => 'Updated the links!',
        ];

        if (! empty($errors)) {
            $response['status'] = 'error';
            $response['message'] = 'There was a problem updating the order.';
            $response['errors'] = $errors;
        }

        return response()->json($response);
    }

    /**
     * Returns the Navigation Tile's javascript
     */
    public function script($slug): \Illuminate\Http\Response
    {
        $navigationTile = NavigationTile::with('navItems')->where('slug', $slug)->firstOrFail();

        $navItems = $navigationTile->navItems->keyBy('order')->toArray();

        return response()->view('admin.nav-tiles.public.script', compact('navigationTile', 'navItems'))
            ->header('Content-Type', 'application/javascript');
    }

    /**
     * Returns the Navigation Tile's stylesheet
     */
    public function style($slug): \Illuminate\Http\Response
    {
        $navigationTile = NavigationTile::where('slug', $slug)->firstOrFail();

        return response()->view('admin.nav-tiles.public.style', compact('navigationTile'))
            ->header('Content-Type', 'text/css');
    }
}
