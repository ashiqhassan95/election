<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCandidatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candidates', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('voter_id');
            $table->string('image')->nullable();
            $table->integer('vote_count')->default(0);
            $table->boolean('is_active')->nullable();

            $table->unsignedInteger('standard_id')->nullable();
            $table->unsignedInteger('position_id')->nullable();
            $table->unsignedInteger('election_id');
            $table->unsignedInteger('institute_id');
            $table->unsignedInteger('user_id')->nullable();

            $table->foreign('voter_id')->references('id')->on('voters')->onDelete('cascade');
            $table->foreign('standard_id')->references('id')->on('standards')->onDelete('set null');
            $table->foreign('position_id')->references('id')->on('positions')->onDelete('set null');
            $table->foreign('election_id')->references('id')->on('elections')->onDelete('cascade');
            $table->foreign('institute_id')->references('id')->on('institutes')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
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
        Schema::dropIfExists('candidates');
    }
}
