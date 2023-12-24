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
        Schema::create('seat_allocations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('trip_id')->constrained();
            $table->unsignedBigInteger('trip_from');
            $table->foreign('trip_from')->references('id')->on('locations')->cascadeOnUpdate()->restrictOnDelete();
            $table->unsignedBigInteger('trip_to');
            $table->foreign('trip_to')->references('id')->on('locations')->cascadeOnUpdate()->restrictOnDelete();
            $table->json('seat_no');
            $table->double('fare_per_seat');
            $table->double('total_fare');
            $table->boolean('is_cancel')->default(0)->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seat_allocations');
    }
};
