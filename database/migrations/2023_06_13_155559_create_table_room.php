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
        Schema::create('room', function (Blueprint $table) {
            $table->id();
            $table->string('room_number', 10);
            $table->string('room_type', 10);
            $table->string('bed', 10);
            $table->double('price');
            $table->enum('status', ['available', 'booked', 'occupied', 'maintenance']);
            $table->dateTime('maintenance_start');
            $table->dateTime('maintenance_end');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('room');
    }
};
