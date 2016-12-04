<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
//use Carbon\Carbon;
class section extends Model{
    protected $table ='section';
    protected $fillable = [

    ];
    public function subjectt(){
      return $this->belongsTo('App\Models\subject','code');
   }


}
