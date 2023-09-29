<?php

use App\Models\SearchLog;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up()
    {
        SearchLog::whereNull('type')->update(['type' => SearchLog::TYPE_SEARCH]);
    }
};
