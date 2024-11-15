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
        Schema::create('time_slots', function (Blueprint $table) {
            $table->id();

            $table->mediumInteger('doctor_id')->unsigned();
            $table->dateTime('start_time');
            $table->dateTime('end_time');
            $table->boolean('is_available')->unsigned()->default(1);
            $table->mediumInteger('appointment_id')->unsigned()->nullable();

            $table->tinyInteger('active')->unsigned()->default(1);
            $table->timestamps();

            $table->index(['doctor_id', 'active'],'doctor_active');
            $table->index(['start_time', 'end_time', 'active'],'time_active');
            $table->index(['is_available', 'active'],'available_active');
            $table->index(['appointment_id', 'active'],'appointment_active');
            $table->index('active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('time_slots');
    }
};
