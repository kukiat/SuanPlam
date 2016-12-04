<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class comment extends Model{
    protected $table ='commentreply';
    protected $date ='created_at';
    protected $fillable = [
        'member_comment_id',
        'blog_comment_id',
        'body',
    ];
    public function setCreatedAtAttribute($date){
      $this->attributes['created_at'] = Carbon::parse($date);
    }
    public function userrrr(){
      return $this->belongsTo('App\Models\member_user','member_comment_id');
    }

}
