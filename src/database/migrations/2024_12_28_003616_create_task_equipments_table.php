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
        Schema::create('task_equipment', function (Blueprint $table) {
            $table->ulid('task_id'); // Match the `ulid` type of `tasks` primary key
            $table->ulid('equipment_id'); // Match the `ulid` type of `user` primary key

            // Foreign key constraints
            $table->foreign('task_id')->references('id')
                ->on('tasks')->onDelete('cascade');
            $table->foreign('equipment_id')->references('id')
                ->on('equipments')->onDelete('cascade');

            // Composite unique index to avoid duplicates
            $table->unique(['task_id', 'equipment_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('task_equipment');
    }
};
