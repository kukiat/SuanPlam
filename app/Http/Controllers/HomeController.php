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
    $dis = 'discussion';
    $re = 'review';
    $ne = 'news';
    $jo = 'job';
    $inter = 'interview';

    $show = Status::orderBy('created_at', 'desc')->get();
    $discussion = Status::where('category','=',$dis)->orderBy('created_at', 'desc')->get();
    $review = Status::where('category','=',$re)->orderBy('created_at', 'desc')->get();
    $news = Status::where('category','=',$ne)->orderBy('created_at', 'desc')->get();
    $job = Status::where('category','=',$jo)->orderBy('created_at', 'desc')->get();
    $interview = Status::where('category','=',$inter)->orderBy('created_at', 'desc')->get();

    return view('feed.index')->with('show', $show)
    ->with('discussion', $discussion)
    ->with('review', $review)
    ->with('news', $news)
    ->with('job', $job)
    ->with('interview', $interview);
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
