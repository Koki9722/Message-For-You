<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateListTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lists', function (Blueprint $table) {
            $table->unsignedInteger('board_id');
            $table->foreign('board_id')->references('id')->on('posts');
            $table->string('id', 35);
            $table->text('board_text');
            $table->unsignedInteger('board_number_now');
            $table->increments('post_number', 11)->autoIncrement();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('list');
    }
}
