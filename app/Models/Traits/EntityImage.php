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
        $attributeName = self::$imageAttribute;

        if ($this->{$attributeName} && strpos($imageValue, $this->{$attributeName}) !== false) {
            // image not changed
            return;
        }

        $diskName = 'public';

        if ($this->{$attributeName}) {
            $oldImagePath = self::$imageFolderPath . DIRECTORY_SEPARATOR . $this->{$attributeName};

            Storage::disk($diskName)->delete($oldImagePath);
        }

        if ($imageValue === null) {
            // image was erased
            $this->attributes[$attributeName] = null;
        } else {
            $imageFilename = Str::slug($this->{self::$imageFilenameAttribute}) . '.png';
            $imagePath     = self::$imageFolderPath . DIRECTORY_SEPARATOR . $imageFilename;

            // uploaded via backpack's CRUD
            if (Str::startsWith($imageValue, 'data:image')) {
                $image = Image::make($imageValue)->encode('png', 90);

                Storage::disk($diskName)->put($imagePath, $image->stream());
            }
            // new image assigned from 'entity merge' or 'listing request'
            elseif ($imageValue !== $this->{$attributeName}) {
                $addedImagePath = self::$imageFolderPath . DIRECTORY_SEPARATOR . $imageValue;

                Storage::disk($diskName)->move($addedImagePath, $imagePath);
            }

            $this->attributes[$attributeName] = $imageFilename;
        }
    }
}
