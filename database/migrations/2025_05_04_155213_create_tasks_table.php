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
        Schema::create('tasks', function (Blueprint $table) {
            
                $table->id();
                $table->string('title');
                $table->text('description');
                $table->foreignId('programmer_id')->constrained('users')->onDelete('cascade');
                $table->foreignId('tester_id')->nullable()->constrained('users')->onDelete('set null');
                $table->enum('status', ['proposed', 'approved', 'in_progress', 'done', 'in_testing', 'tested_done', 'needs_fix']);
                $table->enum('priority', ['low', 'medium', 'high']);
                $table->date('scheduled_for_date');
                $table->date('original_scheduled_date');
                $table->timestamps();
           
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
