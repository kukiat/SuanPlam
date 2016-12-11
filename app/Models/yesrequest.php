<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class yesrequest extends Model{
    protected $table ='yesrequestclub';

    protected $fillable = [
      'member_yesrequestclub_id',
      'club_yesrequestclub_id',
    ];
    public function user(){
      return $this->belongsTo('App\Models\member_user','member_yesrequestclub_id');
    }

}
