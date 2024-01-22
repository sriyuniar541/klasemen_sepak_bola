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
        Schema::create('klasemen', function (Blueprint $table) {
            $table->id();
            $table->integer('klub_id');
            $table->integer('MA')->default(0);
            $table->integer('ME')->default(0);
            $table->integer('S')->default(0);
            $table->integer('K')->default(0);
            $table->integer('GM')->default(0);
            $table->integer('GK')->default(0);
            $table->integer('poin')->default(0);
            $table->timestamps();

            $table->foreign('klub_id')->references('id')->on('klub')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('klasemen');
    }
};
