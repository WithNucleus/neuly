<?php

namespace App\Console\Commands;

use App\Models\Company;
use App\Models\Person;
use Illuminate\Console\Command;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class GenerateEntityPreviewLinks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'previewLinks:generateNew';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generates visibility codes for preview links for entities that don\'t have one';

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
        $allowedEntities = [
            Company::class,
            Person::class
        ];

        foreach ($allowedEntities as $entity) {

            $entities = $entity::pending()->whereNull('visibility_code')->get();

            foreach ($entities as $entityItem) {
                $entityItem->visibility_code = Str::random(40);
                $entityItem->save();
            }
        }

        return 0;
    }
}
