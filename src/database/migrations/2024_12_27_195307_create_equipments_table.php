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
        Schema::create('equipments', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->string('brand_name', length: 60);
            $table->string('model_name', length: 100);
            $table->string('equipment_type', length: 40)->nullable();
            $table->string('registration_number', length: 12)->nullable();
            $table->integer('year_of_manufacture');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipments');
    }
};
