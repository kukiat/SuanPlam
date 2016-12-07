<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePosttagTable extends Migration{

    public function up(){
      Schema::create('posttag', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('post_id')->unsigned();
          $table->foreign('post_id')->references('id')->on('postblog')->onDelete('cascade');
          $table->integer('tag_id')->unsigned();
          $table->foreign('tag_id')->references('id')->on('tag')->onDelete('cascade');

          $table->timestamps();
      });
    }
    public function down(){
      Schema::drop('posttag');
    }
}
