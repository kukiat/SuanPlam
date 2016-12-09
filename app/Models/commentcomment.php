<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class commentcomment extends Model{
    protected $table ='commentincomment';
    protected $date ='created_at';
    protected $fillable = [
        'member_commentincomment_id',
        'comment_commentincomment_id',
        'blog_commentincomment_id',
        'body',
    ];
    public function setCreatedAtAttribute($date){
      $this->attributes['created_at'] = Carbon::parse($date);
    }
    public function members(){
      return $this->belongsTo('App\Models\member_user','member_commentincomment_id');
    }

}
