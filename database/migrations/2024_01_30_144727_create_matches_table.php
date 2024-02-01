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
        Schema::create('matches', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->dateTime('when');
            $table->enum('status',['not_started','finished']);
            $table->string('plan');
            $table->string('channel');
            $table->string('round')->unique();
            $table->string('play_ground');
            $table->unsignedBigInteger('sessions_id')->unique();
            $table->foreign('sessions_id')->on('sessions')->references('id')->onDelete('cascade');
            $table->unsignedBigInteger('club1_id')->unique();
            $table->foreign('club1_id')->on('clubs')->references('id')->onDelete('cascade');
            $table->unsignedBigInteger('club2_id')->unique();
            $table->foreign('club2_id')->on('clubs')->references('id')->onDelete('cascade');
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
        Schema::dropIfExists('matches');
    }
};
