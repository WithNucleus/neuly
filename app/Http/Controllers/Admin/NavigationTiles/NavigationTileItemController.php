<?php

namespace App\Http\Controllers\Admin\NavigationTiles;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreNavigationTileItemRequest;
use App\Models\NavigationTile;
use App\Models\NavigationTileItem;

class NavigationTileItemController extends Controller
{

    /**
     * Stores a newly created Navigation Tile Link
     */
    public function store($id, StoreNavigationTileItemRequest $request): \Illuminate\Http\RedirectResponse
    {
        $navigationTile = NavigationTile::findOrFail($id);
        $attributes = $request->all();
        $attributes['navigation_tile_id'] = $navigationTile->id;
        $navItem = NavigationTileItem::create($attributes);
        return redirect()->route('admin.nav-tiles.edit', $id)->with('navigationTileItemSuccess', 'Added ' . $navItem->name . '!');
    }

    /**
     * Updates a Navigation Tile Item
     */
    public function update($id, StoreNavigationTileItemRequest $request): \Illuminate\Http\RedirectResponse
    {
        $navItem = NavigationTileItem::find($id);

        $type = $request->input('type');

        if ($navItem) {
            $navItem->update($request->all());

            if ($type == 'title') {
                $navItem->url = NULL;
                $navItem->badge = NULL;
                $navItem->save();
            }
        }

        return redirect()->route('admin.nav-tiles.edit', $navItem->navigationTile->id)->with('navItemsSuccess', 'Updated ' . $navItem->name . '!');
    }

    /**
     * Deletes a Navigation Tile Item
     */
    public function delete($id): \Illuminate\Http\JsonResponse
    {
        $response = [
            'status' => 'success',
            'message' => 'Deleted'
        ];

        $navItem = NavigationTileItem::find($id);

        if ($navItem) {
            $navItem->delete();
        } else {
            $response['status'] = 'error';
            $response['message'] = 'There was a problem deleting this...';
        }

        return response()->json($response);
    }
}
