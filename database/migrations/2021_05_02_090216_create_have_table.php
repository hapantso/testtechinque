<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHaveTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('have', function (Blueprint $table) {
            $table->id('id_have');
            $table->unsignedBigInteger('id_answer');
            $table->unsignedBigInteger('id_respondent');
            $table->timestamps();
            $table->foreign('id_answer')->references('id_answer')->on('answers')
            ->onUpdate('cascade')
            ->onDelete('cascade');;
            $table->foreign('id_respondent')->references('id_respondent')->on('respondents')
            ->onUpdate('cascade')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('have');
    }
}
