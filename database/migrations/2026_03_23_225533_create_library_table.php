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
        Schema::create('library_info', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name', 255);
            $table->string('address', 255);
            $table->unsignedBigInteger('phone_number', 11);
            $table->string('email')->nullable();
            $table->longText('description')->nullable();
            $table->dateTime('opening_hour_weekday');
            $table->dateTime('closing_hour_weekday');
            $table->dateTime('opening_hour_weekend');
            $table->dateTime('closing_hour_weekend');

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
