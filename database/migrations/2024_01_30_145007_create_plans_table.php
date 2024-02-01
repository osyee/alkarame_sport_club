<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plans', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->unsignedBigInteger('Players_id')->unique();
            $table->foreign('Players_id')->on('Players')->references('id')->onDelete('cascade');
            $table->unsignedBigInteger('matches_id')->unique();
            $table->foreign('matches_id')->on('matches')->references('id')->onDelete('cascade');
            $table->enum('status',['main','beancg']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('plans');
    }
};
