<?php

namespace App\Console\Commands;

use App\Models\Company;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class updateCompanySlugs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'updateCompanySlugs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update Slugs for Companies';

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
        // Get Company
        $companies = Company::whereNull('slug')->take(20)->get();

        foreach ($companies as $company) {
            // Get Name
            $name = $company->name;

            // Generate Slug
            $slug = Str::slug($name);

            // Update Slug
            $company->slug = $slug;
            $company->update();

            // Print Info
            $this->info('Updated slug for '.$company->name);
        }
    }
}
