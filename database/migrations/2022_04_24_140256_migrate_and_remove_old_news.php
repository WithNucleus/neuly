<?php

use App\Enum\MediaTypes;
use App\Models\Company;
use App\Models\MediaItem;
use App\Models\NewsArticle;
use Illuminate\Database\Migrations\Migration;

class MigrateAndRemoveOldNews extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Migrate old news model to media items
        $oldNews = NewsArticle::all();

        foreach ($oldNews as $oldNewsItem) {
            $attributes = [
                'name' => $oldNewsItem->name,
                'date' => $oldNewsItem->date,
                'status' => MediaItem::STATUS_PUBLIC,
                'media_type' => MediaTypes::MEDIA_TYPE_NEWS,
                'url' => $oldNewsItem->url,
                'content' => 'Published by '.$oldNewsItem->publisher,
                'created_at' => $oldNewsItem->created_at,
                'updated_at' => $oldNewsItem->updated_at,
            ];

            $newNewsItem = MediaItem::create($attributes);

            $organization = Company::where('name', $oldNewsItem->publisher)->first();

            if ($organization) {
                $newNewsItem->companies()->syncWithoutDetaching([$organization->id]);
            }

            // Delete record to remove from Algolia
            $oldNewsItem->delete();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
