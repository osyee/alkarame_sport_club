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
        Schema::create('primes', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->string('name')->unique();
            $table->string('descreption');
            $table->string('image');
            $table->enum('type',['personal','club']);
            $table->unsignedBigInteger('Sports_id')->unique();
            $table->foreign('Sports_id')->on('Sports')->references('id')->onDelete('cascade');
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
        Schema::dropIfExists('primes');
    }
};
