<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class norequest extends Model{
    protected $table ='norequestclub';

    protected $fillable = [
      'member_norequestclub_id',
      'club_norequestclub_id',
    ];
    public function members(){
      return $this->belongsTo('App\Models\member_user','member_norequestclub_id');
    }
    public function clubs(){
      return $this->belongsTo('App\Models\clubmain','club_norequestclub_id');
    }
}
