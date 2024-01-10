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
        Schema::table('parking_history', function (Blueprint $table) {
            $table->timestamp('entered_garage')->nullable();
            $table->timestamp('exited_garage')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('parking_history', function (Blueprint $table) {
            $table->dropColumn('entered_garage');
            $table->dropColumn('exited_garage');
        });
    }
};
