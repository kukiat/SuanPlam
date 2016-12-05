<?php
namespace App\Models;

//use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

class member_user extends Model implements AuthenticatableContract{
    use Authenticatable;
    protected $table ='members';
    protected $fillable = [
        'username',
        'email',
        'password',
        'studentid_name',
        'faculty_name',
        'department_name',
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];
    // public function getName(){
    //   if($this->first_name && $this->last_name){
    //     return "{$this->first_name} {$this->last_name}";
    //   }
    //   if($this->first_name){
    //     return $this->first_name;
    //   }
    //   return null;
    // }
    public function getKey(){
      return "{$this->id}";
    }
    public function getNameOrUsername(){
      return "$this->username";
    }
    // public function getFirstNameOrUsername(){
    //   return $this->firstname ?: $this->username;
    // }
    public function statuses(){
      return $this->hasMany('App\Models\Status','member_id');
    }
    public function statuss(){
     return $this->belongsToMany('App\Models\Status');
    }
    public function commeddd(){
     return $this->hasMany('App\Models\comment','member_comment_id');
    }
    public function commentclass(){
     return $this->hasMany('App\Models\commentinclassroom','classmember_comment_id');
    }

}
