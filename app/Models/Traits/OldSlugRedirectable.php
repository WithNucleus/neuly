<?php

namespace App\Models\Traits;

use App\Notifications\SlugUpdated;
use App\User;

trait OldSlugRedirectable
{
    public function redirects()
    {
        return $this->morphMany('App\Models\Redirect', 'redirectable');
    }

    public static function bootOldSlugRedirectable()
    {
        static::updating(function($model)
        {
            $oldSlug = $model->getOriginal('slug');
            $newSlug = $model->slug ?? Str::slug($model->name);

            if (!empty($oldSlug) && $newSlug !== $oldSlug) {
                $model->redirects()->delete();
                $redirect = $model->redirects()->create(['old_slug' => $oldSlug]);

                $adminEmail = env('SEND_SLUG_UPDATED_NOTIFICATION_EMAIL', null);
                $admin      = $adminEmail ? User::where('email', $adminEmail)->first() : null;

                if ($admin) {
                    $admin->notify(new SlugUpdated($model, $redirect));
                }
            }
        });
    }
}
