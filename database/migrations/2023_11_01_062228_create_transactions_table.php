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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('checkout_link')->nullable();
            $table->string('external_id')->nullable();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('course_id')->nullable()->constrained('courses');
            $table->string('description')->nullable();
            $table->integer('amount');
            $table->string('type'); // 'enrol' | 'withdraw' | 'refund' | '' |
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
