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
        Schema::create('players', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->string('name')->unique();
            $table->integer('high');
            $table->string('play');
            $table->integer('number')->unique();
            $table->date('born');
            $table->string('from');
            $table->string('first_club');
            $table->string('career');
            $table->string('image');
            $table->unsignedBigInteger('Sports_id')->unique();
            $table->foreign('Sports_id')->on('Sports')->references('id')->onDelete('cascade');
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
        Schema::dropIfExists('players');
    }
};
