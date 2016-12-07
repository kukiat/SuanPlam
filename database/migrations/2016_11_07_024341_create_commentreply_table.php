<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentreplyTable extends Migration{

    public function up(){
      Schema::create('commentreply',function(Blueprint $table){
        $table->increments('id');
        $table->integer('member_comment_id')->unsigned();
        $table->foreign('member_comment_id')->references('id')->on('members')->onDelete('cascade');;
        $table->integer('blog_comment_id')->unsigned();
        $table->foreign('blog_comment_id')->references('id')->on('postblog')->onDelete('cascade');;
        $table->text('body');
        $table->timestamps();
      });
    }
    public function down(){
        Schema::drop('commentreply');
    }
}
