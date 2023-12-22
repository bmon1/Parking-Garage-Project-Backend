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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('owner_id');
            $table->foreign('owner_id')->references('id')->on('users');
            $table->year('year');
            $table->string('make');
            $table->string('model');
            $table->string('color');
            $table->string('license_plate');
            $table->boolean('currently_parked');
            $table->unsignedBigInteger('parked_in_garage')->nullable();
            $table->foreign('parked_in_garage')->references('id')->on('garages');
            $table->timestamp('entered_garage')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};