<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFeedtagTable extends Migration{
    public function up(){
      Schema::create('feedtag', function(Blueprint $table) {
          $table->increments('id');
          $table->integer('club_id')->unsigned();
          $table->foreign('club_id')->references('id')->on('clubmain')->onDelete('cascade');
          $table->string('tag_club_name');
          $table->integer('active_tag');
          $table->timestamps();
      });
    }
    public function down(){
      Schema::drop('feedtag');
    }
}
