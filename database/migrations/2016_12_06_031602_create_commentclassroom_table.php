<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentclassroomTable extends Migration{

    public function up(){
      Schema::create('commentclassroom', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('classmember_comment_id')->unsigned();
          $table->foreign('classmember_comment_id')->references('id')->on('members')->onDelete('cascade');
          $table->text('body');
          $table->timestamps();
      });
    }
    public function down()
    {

        Schema::drop('commentclassroom');

    }
}
