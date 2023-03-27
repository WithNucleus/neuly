<?php

namespace App\Console\Commands;

use App\Models\Person;
use Illuminate\Console\Command;

class updatePersonSlugs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'updatePersonSlugs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update Slugs for People';

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
        // Get People
        $people = Person::whereNull('slug')->take(10)->get();

        foreach ($people as $person) {
            $person->slug = Person::generateUniqueSlug($person->name);
            $person->update();

            // Print Info
            $this->info('Updated slug for '.$person->name);
        }
    }
}
