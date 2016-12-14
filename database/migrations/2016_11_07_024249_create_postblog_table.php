<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostblogTable extends Migration{
    public function up(){
      Schema::create('postblog',function(Blueprint $table){
        $table->increments('id');
        $table->integer('member_id');
        $table->text('topic');
        $table->text('body');
        $table->string('category');
        $table->integer('views')->default('0');
        $table->timestamps();
      });
    }

    public function down(){
      Schema::drop('postblog');
    }
}
