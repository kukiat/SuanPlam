<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentincommentTable extends Migration{

    public function up()
    {
      Schema::create('commentincomment', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('member_commentincomment_id')->unsigned();
          $table->foreign('member_commentincomment_id')->references('id')->on('members')->onDelete('cascade');
          $table->integer('comment_commentincomment_id')->unsigned();
          $table->foreign('comment_commentincomment_id')->references('id')->on('commentreply')->onDelete('cascade');
          $table->integer('blog_commentincomment_id')->unsigned();
          $table->foreign('blog_commentincomment_id')->references('id')->on('postblog')->onDelete('cascade');
          $table->text('body');
          $table->timestamps();
      });
    }


    public function down(){
        Schema::drop('commentincomment');
    }
}
