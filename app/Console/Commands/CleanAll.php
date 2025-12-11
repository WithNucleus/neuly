<?php

namespace App\Console\Commands;

use App\GarbageCollection\GarbageCollector;
use App\GarbageCollection\RelationshipCleaner\ActivityLogCleaner;
use App\GarbageCollection\RelationshipCleaner\ClinicalTrialCleaner;
use App\GarbageCollection\RelationshipCleaner\CompanyCleaner;
use App\GarbageCollection\RelationshipCleaner\DataSanitizer;
use App\GarbageCollection\RelationshipCleaner\EmailNotificationCleaner;
use App\GarbageCollection\RelationshipCleaner\EventCleaner;
use App\GarbageCollection\RelationshipCleaner\FailedJobsCleaner;
use App\GarbageCollection\RelationshipCleaner\FocusCleaner;
use App\GarbageCollection\RelationshipCleaner\FollowListCleaner;
use App\GarbageCollection\RelationshipCleaner\InvestorCleaner;
use App\GarbageCollection\RelationshipCleaner\JobCleaner;
use App\GarbageCollection\RelationshipCleaner\LocationCleaner;
use App\GarbageCollection\RelationshipCleaner\NotificationCleaner;
use App\GarbageCollection\RelationshipCleaner\OAuthCleaner;
use App\GarbageCollection\RelationshipCleaner\PermissionCleaner;
use App\GarbageCollection\RelationshipCleaner\PersonCleaner;
use App\GarbageCollection\RelationshipCleaner\RedirectCleaner;
use App\GarbageCollection\RelationshipCleaner\RoleCleaner;
use App\GarbageCollection\RelationshipCleaner\SessionCleaner;
use App\GarbageCollection\RelationshipCleaner\UserCleaner;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CleanAll extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'clean:all 
                            {--only= : Comma-separated list of cleaners to run (e.g., activity-log,failed-jobs,oauth)}
                            {--dry-run : Preview what would be deleted without actually deleting}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run all garbage collection cleaners to remove stale and orphaned data';

    /**
     * Available cleaners mapping
     *
     * @var array
     */
    private $availableCleaners = [
        'clinical-trial' => ClinicalTrialCleaner::class,
        'company' => CompanyCleaner::class,
        'event' => EventCleaner::class,
        'focus' => FocusCleaner::class,
        'investor' => InvestorCleaner::class,
        'job' => JobCleaner::class,
        'location' => LocationCleaner::class,
        'person' => PersonCleaner::class,
        'user' => UserCleaner::class,
        'follow-list' => FollowListCleaner::class,
        'notification' => NotificationCleaner::class,
        'email-notification' => EmailNotificationCleaner::class,
        'role' => RoleCleaner::class,
        'permission' => PermissionCleaner::class,
        'redirect' => RedirectCleaner::class,
        'activity-log' => ActivityLogCleaner::class,
        'failed-jobs' => FailedJobsCleaner::class,
        'oauth' => OAuthCleaner::class,
        'session' => SessionCleaner::class,
        'data-sanitizer' => DataSanitizer::class,
    ];

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
        $isDryRun = $this->option('dry-run');
        $only = $this->option('only');

        if ($isDryRun) {
            $this->warn('🔍 DRY RUN MODE - No data will be deleted');
            $this->newLine();
        }

        $this->info('🧹 Starting garbage collection...');
        $this->newLine();

        // Determine which cleaners to run
        $cleanersToRun = $this->getCleanersToRun($only);

        if (empty($cleanersToRun)) {
            $this->error('No valid cleaners specified.');
            return 1;
        }

        $allMessages = [];

        try {
            foreach ($cleanersToRun as $name => $cleanerClass) {
                $this->info("Running {$name} cleaner...");
                
                // Use individual transactions for each cleaner to avoid long-running transactions
                if ($isDryRun) {
                    DB::beginTransaction();
                }

                try {
                    $cleaner = new $cleanerClass();
                    $messages = $this->getCleanerMessages($cleaner, $name);
                    
                    foreach ($messages as $message) {
                        $this->line("  ✓ {$message}");
                        $allMessages[] = $message;
                    }
                    
                    if ($isDryRun) {
                        DB::rollBack();
                    }
                } catch (\Exception $e) {
                    if ($isDryRun) {
                        DB::rollBack();
                    }
                    $this->warn("  ⚠ Error in {$name}: " . $e->getMessage());
                }
                
                $this->newLine();
            }

            if ($isDryRun) {
                $this->warn('🔍 Dry run completed - No changes were made to the database');
            } else {
                $this->info('✅ Garbage collection completed successfully!');
            }
        } catch (\Exception $e) {
            $this->error('❌ Error during garbage collection: ' . $e->getMessage());
            return 1;
        }

        $this->newLine();
        $this->info('Total operations: ' . count($allMessages));

        return 0;
    }

    /**
     * Get the list of cleaners to run based on options
     *
     * @param string|null $only
     * @return array
     */
    private function getCleanersToRun($only)
    {
        if ($only) {
            $requestedCleaners = array_map('trim', explode(',', $only));
            $cleaners = [];

            foreach ($requestedCleaners as $cleanerName) {
                if (isset($this->availableCleaners[$cleanerName])) {
                    $cleaners[$cleanerName] = $this->availableCleaners[$cleanerName];
                } else {
                    $this->warn("Unknown cleaner: {$cleanerName}");
                }
            }

            return $cleaners;
        }

        return $this->availableCleaners;
    }

    /**
     * Get messages from a cleaner instance
     *
     * @param object $cleaner
     * @param string $name
     * @return array
     */
    private function getCleanerMessages($cleaner, $name)
    {
        // Map cleaner names to their methods
        $methodMap = [
            'clinical-trial' => 'cleanClinicalTrialRelationships',
            'company' => 'cleanCompanyRelation',
            'event' => 'cleanEventRelation',
            'focus' => 'cleanFocusRelation',
            'investor' => 'cleanInvestorRelation',
            'job' => 'cleanJobRelation',
            'location' => 'cleanLocationRelation',
            'person' => 'cleanPersonRelation',
            'user' => 'cleanUserRelation',
            'follow-list' => 'cleanFollowListRelation',
            'notification' => 'cleanNotificationRelation',
            'email-notification' => 'cleanEmailNotificationRelation',
            'role' => 'cleanRoleRelation',
            'permission' => 'cleanPermissionRelation',
            'redirect' => 'cleanRedirectRelation',
            'activity-log' => 'cleanActivityLogRelation',
            'failed-jobs' => 'cleanFailedJobsRelation',
            'oauth' => 'cleanOAuthRelation',
            'session' => 'cleanSessionRelation',
            'data-sanitizer' => 'sanitizeDataRelation',
        ];

        $method = $methodMap[$name] ?? null;

        if ($method && method_exists($cleaner, $method)) {
            return $cleaner->$method();
        }

        return ['No method found for ' . $name];
    }
}
