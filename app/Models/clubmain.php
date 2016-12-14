<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class clubmain extends Model{
    protected $table ='clubmain';

    protected $fillable = [
        'club_name',
        'active',
        'detail',
        'member_request_id',

    ];
    public function members(){
      return $this->belongsTo('App\Models\member_user','member_request_id');
    }
    
    public function norequests(){
      return $this->hasMany('App\Models\norequest','club_norequestclub_id');
    }
    public function feedclubs(){
      return $this->hasMany('App\Models\feedclub','club_id');
    }
}
