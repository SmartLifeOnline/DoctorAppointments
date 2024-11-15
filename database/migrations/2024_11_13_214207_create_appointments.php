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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();

            $table->mediumInteger('doctor_id')->unsigned();
            $table->string('patient_name');
            $table->string('patient_email');
            $table->dateTime('date_time');
            $table->tinyInteger('status_id')->unsigned()->default(1);
            $table->mediumInteger('time_slot_id')->unsigned();

            $table->tinyInteger('active')->unsigned()->default(1);
            $table->timestamps();

            $table->index(['patient_name', 'active'],'patient_name_active');
            $table->index(['patient_email', 'active'],'patient_email_active');
            $table->index(['doctor_id', 'active'],'doctor_active');
            $table->index(['status_id', 'active'],'status_active');
            $table->index('active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
