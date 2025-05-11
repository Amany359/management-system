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
        Schema::create('task_activity_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('task_id')->constrained('tasks')->onDelete('cascade');
            $table->enum('old_status', ['proposed', 'approved', 'in_progress', 'done', 'in_testing', 'tested_done', 'needs_fix']);
            $table->enum('new_status', ['proposed', 'approved', 'in_progress', 'done', 'in_testing', 'tested_done', 'needs_fix']);
            $table->foreignId('changed_by')->constrained('users')->onDelete('cascade');
            $table->text('note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('task_activity_logs');
    }
};
