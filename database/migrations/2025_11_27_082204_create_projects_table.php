<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            
            $table->string('title'); // Required
            $table->text('description'); // Required
            $table->integer('duration'); // Required
            $table->date('start_date'); // Required
            $table->date('end_date'); // Required
            
            $table->unsignedBigInteger('manager_id')->nullable(); // Assigned admin/manager
            $table->unsignedBigInteger('client_id')->nullable(); // Optional client reference
            $table->unsignedBigInteger('created_by'); // Admin who created the project

            $table->string('status')->default('pending'); 
            $table->string('client_name')->nullable(); 
            $table->timestamps();

            // Foreign keys
            $table->foreign('manager_id')->references('id')->on('users')->onDelete('set null');
            //$table->foreign('client_id')->references('id')->on('clients')->onDelete('set null');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
