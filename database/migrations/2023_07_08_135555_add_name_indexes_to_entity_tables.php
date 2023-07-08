<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Symfony\Component\Console\Output\ConsoleOutput;

return new class extends Migration
{
    private array $tables = [
        'bookable_listings' => ['name'],
        'clinicaltrials' => ['title', 'nct_number'],
        'companies' => ['name', 'summary'],
        'courses' => ['name', 'summary'],
        'events' => ['name', 'description'],
        'focus' => ['name'],
        'investors' => ['name'],
        'jobs' => ['job_title', 'job_description'],
        'locations' => ['name'],
        'media_items' => ['name', 'summary', 'content'],
        'people' => ['name', 'email', 'bio'],
        'research' => ['name', 'abstract', 'publication_info'],
        'users' => ['name'],
    ];

    public function up()
    {
        $output = new ConsoleOutput();
        $count = 0;
        $output->writeln("");

        foreach ($this->tables as $currentTable => $columns) {
            $count++;

            foreach ($columns as $column) {

                try {
                    Schema::table($currentTable, function (Blueprint $table) use ($currentTable, $column) {
                        $table->fullText($column);
                    });
                    $output->writeln("<info>{$count} Success for {$currentTable} {$column}</info>");
                } catch (Throwable $exception) {
                    $output->writeln("<error>{$count} {$exception->getMessage()}</error>");
                }
            }
        }
    }


    public function down()
    {
        $output = new ConsoleOutput();
        $count = 0;
        $output->writeln("");

        foreach ($this->tables as $currentTable => $columns) {
            $count++;

            foreach ($columns as $column) {

                try {
                    Schema::table($currentTable, function (Blueprint $table) use ($currentTable, $column) {
                        $table->dropFullText($currentTable . '_' . $column . '_fulltext');
                    });
                    $output->writeln("<info>{$count} Success for {$currentTable} {$column}</info>");
                } catch (Throwable $exception) {
                    $output->writeln("<error>{$count} {$exception->getMessage()}</error>");
                }
            }
        }

    }
};
