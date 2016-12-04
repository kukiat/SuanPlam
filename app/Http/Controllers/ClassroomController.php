<?php
namespace App\Http\Controllers;

use Auth;
use App\Models\member_user;
use App\Models\Status;
use App\Models\section;
use App\Models\comment;
use App\Models\subject;
//use App\Models\reply;
use Illuminate\Http\Request;
use App\Http\Requests;

class ClassroomController extends Controller{
    public function getShow(){
      $yoyo = subject::get();

      return view('feed.classroom')->with('yoyo', $yoyo);
    }

    public function xxx($sub){  //detail 1

    	$yoyo = subject::where('code','=',$sub)->first();
      // return response()->json(array('yoyo'=>$yoyo));
      return $yoyo;
    }
    public function xxxx($su){  //detail 2

      $yoyo = section::where('code','=',$su)->get();

      return $yoyo;
    }
    public function xxxxx($s){ //clearsearch
      // $s = $request->input('cha');
      $y = subject::where('name','LIKE','%'.$s.'%')->orWhere('code','LIKE','%'.$s.'%')->get();
      return $y;
    }
    public function fill($dd,$cc=null){    //search from input
      $sss = subject::where([
        ['code','LIKE',$dd.'%'],
        ['name','LIKE','%'.$cc.'%'],
      ])->orWhere([
        ['code','LIKE',$dd.'%'],
        ['code','LIKE','%'.$cc.'%'],
      ])->get();
      return $sss;
    }

    public function xx(Request $request){
      $x = $request->input('x');
      $id = $request->input('id');
      $section = $request->input('section');
      return response()->json(array('x'=>$x,'id'=>$id,'section'=>$section));

    }



}
