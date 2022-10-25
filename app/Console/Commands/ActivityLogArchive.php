<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use App\Models\Activity;
use Illuminate\Support\Facades\Storage;
use League\Csv\Writer;

class ActivityLogArchive extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'activitylog:archive';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Archive outdated activity log records by type.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $hiddenColumns = ['properties'];
        $daysConfig = config('activitylog.delete_records_older_than_days');
        $currentDate = Carbon::now();
        $dateLimit = $currentDate->subDays($daysConfig);

        $attributes = Activity::first()->getAttributes();

        foreach ($hiddenColumns as $hiddenColumn) {
            unset($attributes[$hiddenColumn]);
        }

        $header = array_keys($attributes);
        $csv = Writer::createFromFileObject(new \SplTempFileObject);
        $csv->insertOne($header);

        Activity::where('log_name', 'pageview')
                ->where('created_at', '<', $dateLimit)
                ->chunk(1000, function($items) use ($csv, $hiddenColumns) {
                    $csv->insertAll($items->makeHidden($hiddenColumns)->toArray());
                });

        $fileName = 'archive_activitylog_pageview_' . $currentDate->toDateTimeString() . '.csv';

        Storage::disk('archive')->put('activity_log/' . $fileName, $csv->toString());
    }
}
