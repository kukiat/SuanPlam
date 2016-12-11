<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClubcommentTable extends Migration{
  public function up(){
    Schema::create('clubcomment', function(Blueprint $table) {
        $table->increments('id');
        $table->integer('member_clubcomment_id')->unsigned();
        $table->foreign('member_clubcomment_id')->references('id')->on('members')->onDelete('cascade');
        $table->integer('feedclub_clubcomment_id')->unsigned();
        $table->foreign('feedclub_clubcomment_id')->references('id')->on('feedclub')->onDelete('cascade');
        $table->text('body');
        $table->timestamps();
    });
  }
  public function down(){
    Schema::drop('clubcomment');
  }
}
