<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTagTable extends Migration{

    public function up(){
      Schema::create('tag',function(Blueprint $table){
        $table->increments('id');
        $table->text('tag_name');
        $table->timestamps();
      });
    }
    public function down(){
        Schema::drop('tag');
    }
}
