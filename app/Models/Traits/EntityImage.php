<?php

namespace App\Models\Traits;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

trait EntityImage
{
    /**
     * @return string|null
     */
    public function getEntityImageUrlAttribute()
    {
        return $this->{self::$imageAttribute} ?
            Storage::url(self::$imageFolderPath . DIRECTORY_SEPARATOR . $this->{self::$imageAttribute}) : null;
    }

    /**
     * @return string|null
     */
    public function getFullImageUrlAttribute()
    {
        return $this->{self::$imageAttribute} ? url($this->getEntityImageUrlAttribute()) : null;
    }

    /**
     * @return array
     */
    public static function getImageImportSettings()
    {
        return [
            'field' => self::$imageAttribute,
            'folder' => self::$imageFolderPath,
        ];
    }

    /**
     * @return string
     */
    public static function getImageUrlPrefix()
    {
        return DIRECTORY_SEPARATOR . 'storage' . DIRECTORY_SEPARATOR . self::$imageFolderPath . DIRECTORY_SEPARATOR;
    }

    /**
     * @param string|null $imageValue
     */
    private function updateImageAttribute($imageValue)
    {
        $diskName        = 'public';
        $attributeName   = self::$imageAttribute;
        $currentFilename = $this->{$attributeName};

        // image not changed
        if ($currentFilename && strpos($imageValue, $currentFilename) !== false) {
            return;
        }

        // remove old image file
        if ($currentFilename) {
            $oldImagePath = self::$imageFolderPath . DIRECTORY_SEPARATOR . $currentFilename;

            Storage::disk($diskName)->delete($oldImagePath);
        }

        // image was erased or set to empty
        if (empty($imageValue)) {
            $this->attributes[$attributeName] = null;
            return;
        }

        // new image uploaded
        $imageFilename = Str::slug($this->{self::$imageFilenameAttribute}) . '.png';
        $imagePath     = self::$imageFolderPath . DIRECTORY_SEPARATOR . $imageFilename;

        if (Str::startsWith($imageValue, 'data:image')) {
            // uploaded via backpack's CRUD
            $image = Image::make($imageValue)->encode('png', 90);

            Storage::disk($diskName)->put($imagePath, $image->stream());
        } elseif ($imageValue !== $currentFilename) {
            // new image assigned from 'entity merge' or 'listing request'
            $addedImagePath = self::$imageFolderPath . DIRECTORY_SEPARATOR . $imageValue;

            if (Storage::disk($diskName)->exists($imagePath)) {
                Storage::disk($diskName)->delete($imagePath);
            }

            Storage::disk($diskName)->move($addedImagePath, $imagePath);
        }

        $this->attributes[$attributeName] = $imageFilename;
    }
}
