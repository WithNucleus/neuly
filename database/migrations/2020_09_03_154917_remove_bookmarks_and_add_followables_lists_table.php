<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('bookmarks');
        Schema::dropIfExists('bookmark_lists');

        Schema::create('follow_lists', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('slug');
            $table->text('description')->nullable();
            $table->boolean('is_public')->default(false);
            $table->timestamps();
            $table->unique(['name', 'user_id']);
        });

        DB::table('followables')->truncate();

        Schema::table('followables', function (Blueprint $table) {
            $table->foreignId('follow_list_id')
                ->after('id')
                ->constrained('follow_lists')
                ->onDelete('cascade');
            $table->text('notes')->nullable()->after('app_notification');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('followables', function (Blueprint $table) {
            $table->dropForeign('followables_follow_list_id_foreign');
            $table->dropColumn('follow_list_id');
            $table->dropColumn('notes');
        });

        Schema::dropIfExists('follow_lists');

        Schema::create('bookmark_lists', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description')->nullable();
            $table->string('slug');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->unique(['name', 'user_id']);
            $table->boolean('is_public')->default(false);
            $table->timestamps();
        });

        Schema::create('bookmarks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bookmark_list_id')->nullable();
            $table->string('name');
            $table->string('slug');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('entity');
            $table->foreignId('entity_id');
            $table->text('notes')->nullable();
            $table->unique(['entity', 'entity_id', 'bookmark_list_id']);
            $table->timestamps();
        });
    }
};
