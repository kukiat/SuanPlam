<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class tag extends Model{
    protected $table ='tag';
    protected $fillable = [
        'tag_name',
    ];
    // public function post(){
    // 	return $this->belongsToMany('App\Models\Status');
    // }

}
