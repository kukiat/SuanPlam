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

    // public function commentcomment(){
    //   return $this->hasMany('App\Models\commentcomment','comment_commentincomment_id');
    // }
}
