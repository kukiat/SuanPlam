<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class tag extends Model{
    protected $table ='tag';
    
    protected $fillable = [
        'tag_name',

    ];


}
