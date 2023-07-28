<?php

return [
    /*
     * The webhook URLs that we'll use to send a message to Slack.
     */
    'webhook_urls' => [
        'default' => 'https://hooks.slack.com/services/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', // #notifications
        'dev' => 'https://hooks.slack.com/services/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' // #dev-notifications
    ],

    /*
     * This job will send the message to Slack. You can extend this
     * job to set timeouts, retries, etc...
     */
    'job' => Spatie\SlackAlerts\Jobs\SendToSlackChannelJob::class,
];
