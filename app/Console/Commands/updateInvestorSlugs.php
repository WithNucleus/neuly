<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Investor;
use Illuminate\Support\Str;

class updateInvestorSlugs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'updateInvestorSlugs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update Slugs for Investors';

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
        // Get Investors
        $investors = Investor::whereNull('slug')->take(20)->get();

        foreach ($investors as $investor) {

            // Get Name
            $name = $investor->name;

            // Generate Slug
            $slug = Str::slug($name);

            // Update Slug
            $investor->slug = $slug;
            $investor->update();

            // Print Info
            $this->info('Updated slug for ' . $investor->name);
        }
    }
}
