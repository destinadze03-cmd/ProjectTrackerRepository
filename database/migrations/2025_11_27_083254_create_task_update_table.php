<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('task_updates', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('task_id');
        $table->unsignedBigInteger('user_id'); // staff
        $table->text('note')->nullable();
        $table->string('screenshot')->nullable(); // uploaded image
        $table->enum('status', ['pending', 'done'])->nullable();
        $table->timestamps();
    });
}

public function down()
{
    Schema::dropIfExists('task_updates');
}
};
