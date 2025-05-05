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
        Schema::create('students', function (Blueprint $table) {
            $table->id(); // Auto-increment BIGINT
            $table->string('studentid');
            $table->string('fname');
            $table->string('lname');
            $table->string('gender');
            $table->date('dob')->nullable();
            $table->string('phone', 50)->nullable();
            $table->string('email')->nullable();
            $table->foreignId('parent_id')->nullable();
            $table->foreignId('address_id')->nullable();
            $table->foreignId('class_id')->nullable();
            $table->string('active', 50)->nullable();
            $table->string('image')->nullable();
            $table->timestamps(); // created_at & updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
