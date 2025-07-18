<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('events', function (Blueprint $table) {
            // Rename the existing 'image' column to 'image_url'
            if (Schema::hasColumn('events', 'image')) {
                $table->renameColumn('image', 'image_url');
            }

            // Add new columns
            $table->string('image_file')->nullable();
            $table->string('category')->nullable();
            $table->time('time')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
            // Roll back the changes
            if (Schema::hasColumn('events', 'image_url')) {
                $table->renameColumn('image_url', 'image');
            }

            $table->dropColumn(['image_file', 'category', 'time']);
        });
    }
};
