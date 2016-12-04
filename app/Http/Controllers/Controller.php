<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;

class Controller extends BaseController
{
    use AuthorizesRequests, AuthorizesResources, DispatchesJobs, ValidatesRequests;
    public function hello(){
      return 'welcome from controller';
    }
    public function page($id,$title=null){
      return 'page '.$id.' '.$title;
    }
    public function getPage(){
      return 'welcome controllereeeee';
    }
    public function getContactUs(){
      return 'contact na';
    }
}
