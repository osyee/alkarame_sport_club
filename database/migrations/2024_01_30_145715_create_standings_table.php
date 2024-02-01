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
        Schema::create('standings', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->integer('win');
            $table->integer('lose');
            $table->integer('draw');
            $table->integer('+/-');
            $table->integer('point');
            $table->integer('play');
            $table->unsignedBigInteger('Clubs_id')->unique();
            $table->foreign('Clubs_id')->on('Clubs')->references('id')->onDelete('cascade');
            $table->unsignedBigInteger('sessions_id')->unique();
            $table->foreign('sessions_id')->on('sessions')->references('id')->onDelete('cascade');
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
        Schema::dropIfExists('standings');
    }
};
