<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Status;
use Auth;
use App\Http\Requests;
use App\Models\member_user;
//use App\Models\member_user;
class HomeController extends Controller{
  public function index(){
    return redirect()->route('feed.index');
  }
  public function feedindex(){
    $dis = 'discussion';
    $re = 'review';
    $ne = 'news';
    $jo = 'job';


    $show = Status::orderBy('created_at', 'desc')->paginate(10);
    $discussion = Status::where('category','=',$dis)->orderBy('created_at', 'desc')->get();
    $review = Status::where('category','=',$re)->orderBy('created_at', 'desc')->get();
    $news = Status::where('category','=',$ne)->orderBy('created_at', 'desc')->get();
    $job = Status::where('category','=',$jo)->orderBy('created_at', 'desc')->get();
    $count = count($show);

    return view('feed.index')->with('show', $show)
    ->with('discussion', $discussion)
    ->with('review', $review)
    ->with('news', $news)
    ->with('job', $job)
    ->with('count',$count);
  }
  public function scrollw(Request $request){
    $num = $request->input('g');
    $count = Status::get();
    $countt = count($count);
    $countt = $countt-$num;
    $show = Status::where('id','=',$countt)->orderBy('created_at', 'desc')->paginate(1);
    $member = member_user::where('id','=',$show[0]->member_id)->get()[0];

    return response()->json(array('show'=>$show,'member'=>$member));
  }
  public function newwwwget(Request $request){
      $news = Status::orderBy('created_at', 'desc')->paginate(10);
      return response()->json(array('news'=>$news));
  }
  public function testt(){
    return view('test');
  }
  public function posttestt(Request $request){
      $qq = $request->input('qq');
      $qqq = $request->input('qqq');
      return response()->json(array('qq'=>$qq,'qqq'=>$qqq));

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
