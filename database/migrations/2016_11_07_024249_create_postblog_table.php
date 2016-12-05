<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostblogTable extends Migration{
    public function up(){
      Schema::create('postblog',function(Blueprint $table){
        $table->increments('id');
        $table->integer('member_id');
        $table->integer('parent_id')->nullable();
        $table->text('topic');
        $table->text('body');
        $table->string('category');
        $table->timestamps();
      });
    }

    public function down(){
      Schema::drop('postblog');
    }
}
