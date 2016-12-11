<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClubmainTable extends Migration
{

    public function up(){
      Schema::create('clubmain', function (Blueprint $table) {
          $table->increments('id');
          $table->string('club_name');
          $table->integer('active');
          $table->text('detail');
          $table->integer('member_request_id')->unsigned();
          $table->foreign('member_request_id')->references('id')->on('members')->onDelete('cascade');
          $table->timestamps();
      });
    }


    public function down(){
      Schema::drop('clubmain');
    }
}
