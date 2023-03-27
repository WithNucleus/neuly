<?php

namespace App\Console\Commands;

use App\Models\Event;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class updateEventSlugs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'updateEventSlugs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update Slugs for Events';

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
        // Get Events
        $events = Event::whereNull('slug')->take(2)->get();

        foreach ($events as $event) {
            // Get Name
            $name = $event->name;

            // Generate Slug
            $slug = Str::slug($name);

            // Update Slug
            $event->slug = $slug;
            $event->update();

            // Print Info
            $this->info('Updated slug for '.$event->name);
        }
    }
}
