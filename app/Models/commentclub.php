<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class commentclub extends Model{
    protected $table ='clubcomment';

    protected $fillable = [
        'member_clubcomment_id',
        'feedclub_clubcomment_id',
        'body',
    ];


}
