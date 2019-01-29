<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVotersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('voters', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('admission_number')->nullable();
            $table->string('roll_number')->nullable();
            $table->string('uid')->nullable();
            $table->date('birth_date')->nullable();
            $table->tinyInteger('gender')->nullable();

            $table->unsignedInteger('standard_id');
            $table->unsignedInteger('institute_id');
            $table->unsignedInteger('user_id')->nullable();

            $table->foreign('standard_id')->references('id')->on('standards')->onDelete('cascade');
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
        Schema::dropIfExists('voters');
    }
}
