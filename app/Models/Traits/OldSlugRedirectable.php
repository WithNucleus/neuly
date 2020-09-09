<?php

namespace App\Models\Traits;

use App\Notifications\SlugUpdated;
use Illuminate\Support\Facades\Notification;

trait OldSlugRedirectable
{
    public function redirects()
    {
        return $this->morphMany('App\Models\Redirect', 'redirectable');
    }

    public static function bootOldSlugRedirectable()
    {
        static::updating(function ($model) {
            $oldSlug = $model->getOriginal('slug');
            $newSlug = $model->slug ?? Str::slug($model->name);

            if (!empty($oldSlug) && $newSlug !== $oldSlug) {
                $model->redirects()->delete();
                $redirect = $model->redirects()->create(['old_slug' => $oldSlug]);

                $emailToSettings = env('SEND_SLUG_UPDATED_NOTIFICATION_EMAIL');
                $emailToArray    = array_map('trim', explode(',', $emailToSettings));
                $notification    = new SlugUpdated($model, $redirect);

                foreach ($emailToArray as $email) {
                    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        Notification::route('mail', $email)->notify($notification);
                    }
                }
            }
        });
    }
}
