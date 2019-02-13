<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVoteCasteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vote_cast', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('voter_id')->nullable();
            $table->unsignedInteger('candidate_id')->nullable();
            $table->unsignedInteger('position_id')->nullable();
            $table->unsignedInteger('election_id')->nullable();
            $table->unsignedInteger('institute_id')->nullable();
            $table->dateTime('voted_at')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vote_cast');
    }
}
