<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class feedtag extends Model{
    protected $table ='feedtag';
    protected $fillable = [
        'feedclub_id',
        'tag_club_name',
        'active_tag'
    ];


}
