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
        Schema::table('users', function (Blueprint $table) {
            $table->integer('age')->nullable(); // เพิ่มคอลัมน์ 'age'
            $table->string('gender')->nullable(); // เพิ่มคอลัมน์ 'gender'
            $table->string('user_picture')->nullable(); // เพิ่มคอลัมน์ 'address'
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
