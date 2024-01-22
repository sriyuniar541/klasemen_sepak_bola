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
        Schema::create('skor', function (Blueprint $table) {
            $table->id();
            $table->integer('klub_id');
            $table->integer('skor')->default(0);
            $table->integer('klub_id_lawan');
            $table->integer('skor_lawan')->default(0);
            $table->timestamps();


            // foreign ke tabel skor
            $table->foreign('klub_id')->references('id')->on('klub')->onDelete('cascade');
            $table->foreign('klub_id_lawan')->references('id')->on('klub')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('skor');
    }
};
