<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateYesrequestclubTable extends Migration{

    public function up(){
      Schema::create('yesrequestclub', function(Blueprint $table) {
          $table->increments('id');
          $table->integer('member_yesrequestclub_id')->unsigned();
          $table->foreign('member_yesrequestclub_id')->references('id')->on('members')->onDelete('cascade');
          $table->integer('club_yesrequestclub_id')->unsigned();
          $table->foreign('club_yesrequestclub_id')->references('id')->on('clubmain')->onDelete('cascade');
          $table->timestamps();
      });
    }
    public function down(){
        Schema::drop('yesrequestclub');
    }
}
