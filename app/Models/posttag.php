<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class posttag extends Model{
    protected $table ='posttag';

    protected $fillable = [
      'post_id',
      'tag_id',
    ];
    public function tags(){
      return $this->belongsTo('App\Models\tag','tag_id');
    }

}
