<?php

namespace App\Jobs\Metrics;

use App\Helpers\NotificationHelper;
use App\Models\Metric;
use App\Notifications\Metrics\DailyMetrics;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class MetricsChange implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected Metric $metric;
    protected string $type;
    protected string $frequency;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Metric $metric, string $type, string $frequency)
    {
        $this->metric = $metric;
        $this->type = $type;
        $this->frequency = $frequency;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $metricFields = Metric::METRICS_FIELDS;

        $previousMetric = $this->getPreviousMetricRecord($this->frequency, $this->metric->date);

        $attributes = [
            'date' => $this->metric->date,
            'type' => $this->type,
            'frequency' => $this->frequency
        ];

        foreach ($metricFields as $key) {
            $attributes[$key] = $this->metric->$key - $previousMetric->$key;
        }

        $changeRecord = Metric::create($attributes);
        NotificationHelper::sendSlackNotification(new DailyMetrics($changeRecord), 'metrics_change');
    }

    private function getPreviousMetricRecord($frequency, $currentDate): Metric
    {
        $date = match ($frequency) {
            Metric::FREQUENCY_WEEKLY => Carbon::parse($currentDate)->subWeek(),
            Metric::FREQUENCY_MONTHLY => Carbon::parse($currentDate)->subMonth(),
            Metric::FREQUENCY_QUARTERLY => Carbon::parse($currentDate)->subQuarter(),
            Metric::FREQUENCY_YEARLY => Carbon::parse($currentDate)->subYear(),
            default => Carbon::parse($currentDate)->subDay(),
        };

        return Metric::where('date', $date)->firstOrFail();
    }
}
