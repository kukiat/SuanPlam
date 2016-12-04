<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
//use Carbon\Carbon;
class subject extends Model{
    protected $table ='subject';
    protected $fillable = [

    ];
    public function sectionn(){
      return $this->hasMany('App\Models\section','code');
    }



}
