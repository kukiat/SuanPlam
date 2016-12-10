<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFeedclubTable extends Migration{
  public function up(){
    Schema::create('feedclub', function (Blueprint $table) {
        $table->increments('id');
        $table->integer('club_id')->unsigned();
        $table->foreign('club_id')->references('id')->on('clubmain')->onDelete('cascade');
        $table->text('topic');
        $table->text('body');
        $table->timestamps();
    });
  }


  public function down(){
    Schema::drop('feedclub');
  }
}
