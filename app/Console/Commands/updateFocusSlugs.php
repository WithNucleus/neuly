<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Focus;
use Illuminate\Support\Str;

class updateFocusSlugs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'updateFocusSlugs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update Slugs for Focus Cats';

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
        // Get Focus
        $focus_cats = Focus::whereNull('slug')->take(20)->get();

        foreach ($focus_cats as $focus) {

            // Get Name
            $name = $focus->name;

            // Generate Slug
            $slug = Str::slug($name);

            // Update Slug
            $focus->slug = $slug;
            $focus->update();

            // Print Info
            $this->info('Updated slug for ' . $focus->name);
        }
    }
}