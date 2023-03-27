<?php

namespace App\Console\Commands;

use App\Models\Location;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class updateLocationSlugs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'updateLocationSlugs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update Slugs for Locations';

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
     * @return mixed
     */
    public function handle()
    {
        // Get Locations
        $locations = Location::whereNull('slug')->take(20)->get();

        foreach ($locations as $location) {
            // Get Name
            $name = $location->name;

            // Generate Slug
            $slug = Str::slug($name);

            // Update Slug
            $location->slug = $slug;
            $location->update();

            // Print Info
            $this->info('Updated slug for '.$location->name);
        }
    }
}
