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
        Schema::table('chapters', function (Blueprint $table) {
            $table->unsignedBigInteger('next_chapter_id')->nullable();
            $table->foreign('next_chapter_id')->references('id')->on('chapters');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('chapters', function (Blueprint $table) {
            $table->dropForeign(['next_chapter_id']);
            $table->dropColumn('next_chapter_id');
        });
    }
};
