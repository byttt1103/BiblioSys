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
        Schema::create('library', function (Blueprint $table) {
            $table->uuid('id')->primaryKey();
            $table->string('name', 100);
            $table->foreignId('owner')->constrained('users')->onDelete('restrict');
            $table->string('address', 255);
            $table->unsignedBigInteger('phone_number')->unique()->nullable();
            $table->string('email')->nullable();
            $table->longText('description')->nullable();
            $table->time('opening_hour_weekday');
            $table->time('closing_hour_weekday');
            $table->time('opening_hour_weekend');
            $table->time('closing_hour_weekend');
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('library_info');
    }
};
