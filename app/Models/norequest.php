<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class norequest extends Model{
    protected $table ='norequestclub';

    protected $fillable = [
      'member_norequestclub_id',
      'club_norequestclub_id',
    ];
    

}
