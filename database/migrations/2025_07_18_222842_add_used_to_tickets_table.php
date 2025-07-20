<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;


return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('tickets', function (Blueprint $table) {
            $table->string('ticket_code')->nullable(); // Remove unique for now
            $table->boolean('used')->default(false);
        });

        // Populate ticket_code with unique values
        DB::table('tickets')->get()->each(function ($ticket) {
            DB::table('tickets')->where('id', $ticket->id)->update([
                'ticket_code' => strtoupper(uniqid('TICKET_')),
            ]);
        });

        // Then add the unique constraint
        Schema::table('tickets', function (Blueprint $table) {
            $table->unique('ticket_code');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tickets', function (Blueprint $table) {
            $table->dropUnique(['ticket_code']);
            $table->dropColumn(['ticket_code', 'used']);
        });
    }
};
