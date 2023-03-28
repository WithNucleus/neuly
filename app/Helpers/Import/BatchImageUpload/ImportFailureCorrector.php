<?php

namespace App\Helpers\Import\BatchImageUpload;

use App\Models\Contracts\EntityImageContract;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ImportFailureCorrector
{
    /**
     * @param  \App\Models\ImportFailure  $importFailure
     * @param  \Illuminate\Http\UploadedFile  $imageFile
     * @return bool
     *
     * @throws \Exception
     */
    public static function correctFailure($importFailure, $imageFile)
    {
        $validator = Validator::make(['file' => $imageFile], ['file' => 'image']);

        if ($validator->fails()) {
            return false;
        }

        $isSuccess = self::addImage($importFailure, $imageFile);

        if ($isSuccess === true) {
            $importFailure->delete();
        }

        return $isSuccess;
    }

    /**
     * Upload image for entity
     *
     * @param  \App\Models\ImportFailure  $importFailure
     * @param  \Illuminate\Http\UploadedFile  $imageFile
     * @return bool
     */
    private static function addImage($importFailure, $imageFile)
    {
        $isSuccess = false;
        $targetId = $importFailure->details['target_id'];
        $targetClass = $importFailure->details['target_class'];
        $diskPublic = Storage::disk('public');

        try {
            $targetEntity = $targetClass::findOrFail($targetId);

            if ($targetEntity instanceof EntityImageContract === false) {
                $message = "Entity '$targetClass' is not an instance of '".EntityImageContract::class."'.";
                throw new \Exception($message);
            }

            $imageSettings = $targetClass::getImageImportSettings();
            $entityImageField = $imageSettings['field'];
            $entityImageFolder = $imageSettings['folder'];
            $newImageValue = $entityImageFolder.DIRECTORY_SEPARATOR.uniqid().'.'.$imageFile->extension();

            if ($oldImage = $targetEntity->{$entityImageField}) {
                $diskPublic->delete($oldImage);
            }

            if ($isSuccess = $diskPublic->put($newImageValue, $imageFile->get())) {
                $targetEntity->{$entityImageField} = $newImageValue;
                $targetEntity->save();
            }
        } catch (\Throwable $e) {
            Log::error(
                "Unable to resolve ImportFailure [id = {$importFailure->id}].\n".
                'ErrorMessage: '.$e->getMessage()
            );
        }

        return $isSuccess;
    }
}
