<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exams', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('text');
            $table->text('video');
            $table->text('statute');
            $table->string('time_limit', 10);
            $table->smallInteger('attempts');
            $table->smallInteger('question');
            $table->smallInteger('pass');
            $table->string('date_start', 12);
            $table->string('date_end', 12);
            $table->string('exam_dates', 190);
            $table->boolean('active');
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
        Schema::dropIfExists('exams');
    }
}
