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
        Schema::create('doctors', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->mediumInteger('specialization_id')->unsigned();

            $table->tinyInteger('active')->unsigned()->default(1);
            $table->timestamps();

            $table->index(['name', 'active'],'name_active');
            $table->index(['specialization_id', 'active'],'specialization_active');
            $table->index('active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctors');
    }
};
