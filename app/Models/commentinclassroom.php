<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class commentinclassroom extends Model{
    protected $table ='commentclassroom';
    protected $date ='created_at';
    protected $fillable = [
        'classmember_comment_id',
        'classsubject_comment_id',
        'body',
    ];
    public function setCreatedAtAttribute($date){
      $this->attributes['created_at'] = Carbon::parse($date);
    }
    public function userrrrrr(){
      return $this->belongsTo('App\Models\member_user','classmember_comment_id');
    }

}
