<?php

namespace App\Http\Controllers\Admin\Import;

use App\Helpers\EntityHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Import\BatchImagesUploadRequest;
use App\Jobs\Import\BatchImageUpload;
use App\Models\Company;
use App\Models\Event;
use App\Models\ImportResult;
use App\Models\Investor;
use App\Models\Person;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use ZipArchive;

class BatchImagesUploadController extends Controller
{
    private $allowedCsvColumns = [
        'id',
        'name',
        'image',
    ];

    public function index()
    {
        $importResults = ImportResult::batchImagesUpload()->latest()->take(20)->get();

        $entitiesWithImages = [
            Company::class,
            Person::class,
            Investor::class,
            Event::class,
        ];
        $entityTypes = array_intersect(EntityHelper::getEntities(), $entitiesWithImages);
        $allowedColumns = implode(', ', $this->allowedCsvColumns);

        return view('admin.import.batch-images-upload.index',
            compact('entityTypes', 'importResults', 'allowedColumns'));
    }

    public function import(BatchImagesUploadRequest $request)
    {
        $disk = Storage::disk('batch-images-upload');
        $disk->delete($disk->allFiles());

        //Validate CSV header and map columns
        $records = array_map('str_getcsv', file($request->file('csv')));
        $headings = array_shift($records);
        $columnIndexes = [];

        foreach ($headings as $index => $column) {
            $lowerColumn = strtolower($column);

            if (in_array($lowerColumn, $this->allowedCsvColumns) === false) {
                return redirect()
                    ->back()
                    ->with('error', "Column '$column' is not allowed! Allowed columns are: ".implode(', ', $this->allowedCsvColumns).'.');
            }

            $columnIndexes[$lowerColumn] = $index;
        }

        //Check ZIP file and extract images
        $zipFile = $request->file('images');
        $zip = new ZipArchive();

        if ($zip->open($zipFile) !== true) {
            return redirect()
                ->back()
                ->with('error', "Can't open zip file.");
        }

        $extractToPath = $disk->getAdapter()->getPathPrefix();

        $zip->extractTo($extractToPath);
        $zip->close();

        //begin parse CSV file
        $entityClass = $request->input('entity_type');
        $importResult = ImportResult::create([
            'type' => ImportResult::TYPE_BATCH_IMAGES_UPLOAD,
            'entity' => $entityClass,
            'csv' => json_encode($records),
            'user_id' => Auth::id(),
        ]);

        foreach ($records as $record) {
            $entityId = $record[$columnIndexes['id']];
            $imageFilename = trim($record[$columnIndexes['image']]);

            if ($imageFilename) {
                BatchImageUpload::dispatch($importResult, $entityClass, $entityId, $imageFilename);
            }
        }

        return redirect()->route('import.batch-images-upload.index')->with('success', 'Import started!');
    }

    public function results($id)
    {
        $result = ImportResult::batchImagesUpload()->findOrFail($id);
        $csv = json_decode($result->csv);

        return view('admin.import.batch-images-upload.results', compact('result', 'csv'));
    }

    public function failures($id)
    {
        $result = ImportResult::with('failures')
            ->batchImagesUpload()
            ->findorFail($id);
        $failuresTotalByType = [];

        foreach ($result->failures as $failure) {
            if (isset($failuresTotalByType[$failure->type])) {
                $failuresTotalByType[$failure->type]++;
            } else {
                $failuresTotalByType[$failure->type] = 1;
            }
        }

        return view('admin.import.batch-images-upload.failures', compact('result', 'failuresTotalByType'));
    }
}
