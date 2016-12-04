<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMembersTable extends Migration{

    public function up(){
      Schema::create('members',function(Blueprint $table){
        $table->increments('id');
        $table->string('email');
        $table->string('username');
        $table->string('password');
        $table->string('studentid_name')->nullable();
        $table->string('faculty_name')->nullable();
        $table->string('avatar')->default('default.jpg');
        $table->string('department_name')->nullable();
        $table->string('remember_token')->nullable();
        $table->timestamps();
      });
    }
    public function down(){
      Schema::drop('members');
    }
}
