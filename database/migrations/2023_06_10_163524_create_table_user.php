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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('no_ktp', 24);
            $table->string('email', 65);
            $table->string('fullname', 65);
            $table->string('phone_number', 15);
            $table->string('address', 255);
            $table->string('nationality', 25);
            $table->string('username', 25);
            $table->string('password', 65);
            $table->enum('status', ['aktif', 'nonaktif']);
            $table->enum('role', array('admin', 'user'));
            $table->timestamps();

            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::drop('users');
    }
};
