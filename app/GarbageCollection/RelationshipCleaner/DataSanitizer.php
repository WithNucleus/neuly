<?php

namespace App\GarbageCollection\RelationshipCleaner;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DataSanitizer
{
    private $injectionPatterns = [
        '/<script\b[^>]*>(.*?)<\/script>/is',
        '/<iframe\b[^>]*>(.*?)<\/iframe>/is',
        '/javascript:/i',
        '/on\w+\s*=/i', // on* event handlers like onclick=
        '/<embed\b[^>]*>/i',
        '/<object\b[^>]*>/i',
    ];

    private $sqlInjectionPatterns = [
        '/(\bUNION\b.*\bSELECT\b)/i',
        '/(\bDROP\b.*\bTABLE\b)/i',
        '/(\bEXEC\b.*\bxp_cmdshell\b)/i',
        '/(;\s*DROP\b)/i',
    ];

    public function sanitizeDataRelation()
    {
        $messages = [];

        // Sanitize research_requests table if it exists
        if (Schema::hasTable('research_requests')) {
            $messages[] = $this->sanitizeTable('research_requests', ['description', 'notes']);
        }

        // Sanitize feedback table if it exists
        if (Schema::hasTable('feedback')) {
            $messages[] = $this->sanitizeTable('feedback', ['message', 'body']);
        }

        return $messages;
    }

    private function sanitizeTable($tableName, $columns)
    {
        $sanitizedCount = 0;

        // Get all columns that exist in the table
        $tableColumns = Schema::getColumnListing($tableName);
        $columnsToCheck = array_intersect($columns, $tableColumns);

        if (empty($columnsToCheck)) {
            return 'No columns to sanitize in '.$tableName.' table.';
        }

        $records = DB::table($tableName)->get();

        foreach ($records as $record) {
            $needsUpdate = false;
            $updates = [];

            foreach ($columnsToCheck as $column) {
                if (isset($record->$column) && is_string($record->$column)) {
                    $cleaned = $this->detectAndClean($record->$column);
                    if ($cleaned !== $record->$column) {
                        $updates[$column] = $cleaned;
                        $needsUpdate = true;
                    }
                }
            }

            if ($needsUpdate) {
                DB::table($tableName)
                    ->where('id', $record->id)
                    ->update($updates);
                $sanitizedCount++;
            }
        }

        return 'Sanitized '.$sanitizedCount.' records in '.$tableName.' table.';
    }

    private function detectAndClean($text)
    {
        $original = $text;

        // Remove script injection patterns
        foreach ($this->injectionPatterns as $pattern) {
            $text = preg_replace($pattern, '', $text);
        }

        // Remove SQL injection patterns
        foreach ($this->sqlInjectionPatterns as $pattern) {
            $text = preg_replace($pattern, '', $text);
        }

        // Remove null bytes
        $text = str_replace("\0", '', $text);

        return $text;
    }
}
