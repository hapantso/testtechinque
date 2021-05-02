<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormPagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_pages', function (Blueprint $table) {
            $table->id('id_form_page');
            $table->unsignedInteger('form_page_number');
            $table->unsignedBigInteger('id_form');
            $table->timestamps();
            $table->foreign('id_form')->references('id_form')->on('forms')
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
        Schema::dropIfExists('form_pages');
    }
}
