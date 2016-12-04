<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Status;
use Auth;
use App\Http\Requests;

//use App\Models\member_user;
class HomeController extends Controller{
  public function index(){
    return view('home');
  }
  public function feedindex(){
    $show = Status::orderBy('created_at', 'desc')->get();
    return view('feed.index')->with('show', $show);
  }
  public function testt(){
    return view('test');
  }


  public function postja(){
    return view('postja');
  }
  public function postjaa(Request $request){
    $x = $request->input('x');
    return $x;
  }
  public function getUploadForm() {
		return view('gg');
	}




}
