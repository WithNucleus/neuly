<?php

namespace App\Jobs\Import;

use App\Helpers\EntityHelper;
use App\Models\Contracts\EntityImageContract;
use App\Models\ImportFailure;
use App\Models\ImportResult;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class BatchImageUpload implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var int
     */
    public $tries = 1;

    /**
     * @var mixed
     */
    private $entity;

    /**
     * @var \App\Models\ImportResult
     */
    private $importResult;

    /**
     * @var string
     */
    private $imageFilename;

    /**
     * @var array
     */
    private $imageSettings;

    /**
     * @var array
     */
    private $importSuccessMessages = [];

    /**
     * @var array
     */
    private $importFailedRecords = [];

    /**
     * ProcessLocation constructor.
     * @param \App\Models\ImportResult $importResult
     * @param string $entityClass
     * @param int $entityId
     * @param string $imageFilename
     *
     * @throws \Exception
     */
    public function __construct(ImportResult $importResult, $entityClass, $entityId, $imageFilename)
    {
        $this->importResult  = $importResult;
        $this->imageFilename = $imageFilename;
        $this->entity        = $entityClass::find($entityId);

        if ($this->entity === null) {
            $message = "Entity '$entityClass' with ID $entityId not found.";
            Log::error($message);
            throw new \Exception($message);
        }

        if ($this->entity instanceof EntityImageContract === false) {
            $message = "Entity '$entityClass' is not an instance of '" . EntityImageContract::class . "'." ;
            Log::error($message);
            throw new \Exception($message);
        }

        $this->imageSettings = $entityClass::getImageImportSettings();
    }

    /**
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function handle()
    {
        $diskUpload = Storage::disk('batch-images-upload');
        $diskPublic = Storage::disk('public');

        try {
            $imageContent = $diskUpload->get($this->imageFilename);
        } catch (FileNotFoundException $e) {
            $this->addFailedRecord();
            return false;
        }

        $entityImageField  = $this->imageSettings['field'];
        $entityImageFolder = $this->imageSettings['folder'];
        $imageExtension = File::extension($this->imageFilename);
        $newImageValue  = $entityImageFolder .  DIRECTORY_SEPARATOR . uniqid() . '.' . $imageExtension;

        if ($this->entity->{$entityImageField}) {
            $diskPublic->delete($this->entity->{$entityImageField});
        }

        $diskPublic->put($newImageValue, $imageContent);

        $this->entity->{$entityImageField} = $newImageValue;
        $this->entity->save();

        $diskUpload->delete($this->imageFilename);
    }

    /**
     * @return void
     */
    private function addFailedRecord()
    {
        $record = [
            'target_id'    => $this->entity->id,
            'target_class' => get_class($this->entity),
            'import_value' => $this->imageFilename
        ];

        ImportFailure::create([
            'import_result_id' => $this->importResult->id,
            'type'             => ImportFailure::TYPE_IMAGE,
            'details'          => $record,
        ]);
    }

}
