<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserModuleLessonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_module_lessons', function (Blueprint $table) {
            $table->bigInteger('user_module_id')->unsigned();
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->bigInteger('teacher_id')->unsigned();


            $table->primary(['user_module_id','start_date']);
            $table->foreign('user_module_id')->references('id')->on('user_modules')->onDelete('cascade');
            $table->foreign('teacher_id')->references('id')->on('teachers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_module_lessons');
    }
}
