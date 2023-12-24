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
        Schema::create('fares', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('base_location');
            $table->foreign('base_location')->references('id')->on('locations')->cascadeOnUpdate()->restrictOnDelete();
            $table->unsignedBigInteger('start_from');
            $table->foreign('start_from')->references('id')->on('locations')->cascadeOnUpdate()->restrictOnDelete();
            $table->unsignedBigInteger('destination');
            $table->foreign('destination')->references('id')->on('locations')->cascadeOnUpdate()->restrictOnDelete();
            $table->double('fare_amt');
            $table->date('effect_from')->useCurrent();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fares');
    }
};
