<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class Status extends Model{
    protected $table ='postblog';
    protected $date ='created_at';
    protected $fillable = [
        'topic',
        'body'
    ];
    public function member_userr(){
      return $this->belongsTo('App\Models\member_user','member_id');
   }
   public function setCreatedAtAttribute($date){
     $this->attributes['created_at'] = Carbon::parse($date);
   }
   public function members(){
    return $this->belongsToMany('App\Models\member_user');
   }

}
