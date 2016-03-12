<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClassroomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classrooms', function (Blueprint $table) {
            $table->string('id');
            $table->integer('subject_id')->unsigned();
            $table->integer('major_id')->unsigned();
            $table->string('grade', 5);
            $table->string('logo', 150);
            $table->string('cover', 150);
            $table->timestamps();

            $table->primary(['id']);

            $table->foreign('subject_id')->references('id')->on('subjects')->onDelete('cascade');
            $table->foreign('major_id')->references('id')->on('majors')->onDelete('cascade');
        });

        Schema::create('classroom_user', function (Blueprint $table) {
            $table->string('classroom_id');
            $table->string('user_id');
            $table->foreign('classroom_id')->references('id')->on('classrooms')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->primary(['user_id', 'classroom_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('classroom_user');
        Schema::drop('classrooms');
    }
}