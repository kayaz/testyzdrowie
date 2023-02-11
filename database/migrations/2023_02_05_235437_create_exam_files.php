<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamFiles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('exam_id');
            $table->char('name');
            $table->char('file');
            $table->char('description')->nullable();
            $table->char('extension')->nullable();
            $table->char('mime')->nullable();
            $table->char('size')->nullable();
            $table->bigInteger('download')->default(0);
            $table->bigInteger('position')->default(0);
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
        Schema::dropIfExists('files');
    }
}
