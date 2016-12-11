<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class feedclub extends Model{
    protected $table ='feedclub';
    protected $date ='created_at';
    protected $fillable = [
        'club_id',
        'member_id',
        'topic',
        'body',
    ];
    public function setCreatedAtAttribute($date){
      $this->attributes['created_at'] = Carbon::parse($date);
    }
    public function user(){
      return $this->belongsTo('App\Models\member_user','member_id');
    }
    // public function commentcomment(){
    //   return $this->hasMany('App\Models\commentcomment','comment_commentincomment_id');
    // }
}
