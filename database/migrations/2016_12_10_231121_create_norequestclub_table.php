<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNorequestclubTable extends Migration{

    public function up(){
      Schema::create('norequestclub', function(Blueprint $table) {
          $table->increments('id');
          $table->integer('member_norequestclub_id')->unsigned();
          $table->foreign('member_norequestclub_id')->references('id')->on('members')->onDelete('cascade');
          $table->integer('club_norequestclub_id')->unsigned();
          $table->foreign('club_norequestclub_id')->references('id')->on('clubmain')->onDelete('cascade');
          $table->timestamps();
      });
    }
    public function down(){
      Schema::drop('norequestclub');
    }
}
