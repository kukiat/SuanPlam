<?php
namespace App\Http\Controllers;

use Auth;
use App\Models\member_user;
use App\Models\Status;
use App\Models\comment;
use App\Models\tag;
use App\Models\posttag;
use Validator;
use App\Http\Requests\requestcomment;

use Illuminate\Http\Request;
//use App\Http\Requests;

class FeedController extends Controller{

  public function postStatus(Request $request){
    //  dd($request->tag_select[2]);
    // dd(count($request->tag_select));

    $this->validate($request, [
      'topic' => 'required|max:100',
      'txx' => 'required|max:5000',
    ]);
    Auth::user()->statuses()->create([
      'topic' => $request->input('topic'),
      'body' => $request->input('txx'),
      'category' => $request->input('categoryy'),
    ]);
    $postauth = Status::where('member_id','=',Auth::user()->id)->orderBy('created_at', 'desc')->first();

    for ($x = 0; $x < count($request->tag_select); $x++){
      $posttag = new posttag;
      $posttag->post_id = $postauth->id;
      $posttag->tag_id = $request->tag_select[$x];
      $posttag->save();
    }

    return redirect()->route('feed.index')->with('info','โพสเรียบร้อย');

  }

  public function Blog($blog){
    $val = Status::where('id', '=', $blog)->get();
    $send = comment::where('blog_comment_id', '=', $blog)->get();
    $posttag = posttag::where('post_id', '=', $blog)->get();
    //เช็ค if มี blog นั้นจริงๆหรทอป่าว แต่ยังไม่ทำ

      return view('feed.showw')
      ->with('val', $val)
      ->with('blog', $blog)
      ->with('send', $send)
      ->with('posttag',$posttag);



  }
  public function postComment(Request $request,requestcomment $formulario,$blog){

      $vali = Validator::make(
        $formulario->all(),
        $formulario->rules(),
        $formulario->messages()
      );
      $cv = $request->input('textcomment');
      $create = new comment([
        'member_comment_id' => Auth::user()->id,
        'blog_comment_id' => $blog,
        'body' => $cv,
      ]);
      $create->save();
      $vv = comment::where([
        ['member_comment_id','=',Auth::user()->id],
        ['blog_comment_id','=',$blog],
        ['body','=',$cv],
      ])->first();
      $xx = member_user::where('id', '=', $vv->member_comment_id)->first();
      return response()->json(array('vv'=>$vv,'xx'=>$xx));




    // if ($vali->valid()){
    //   if ($formulario->ajax()){
    //     $create = new comment([
    //     //   'member_comment_id' => Auth::user()->id,
    //     //   'blog_comment_id' => $blog,
    //     //   'body' => $request->input('textcomment'),
    //     // ]);
    //     // $create->save();
    //
    //     return response()->json(["valid" => true], 200);
    //   }
    // }
  }
  public function createtopic(){
    $tag = tag::get();
    return view('feed.createtopic')->with('tag',$tag);
  }
  public function addcageory(Request $request){

      $tagg = new tag;
      $tagg->tag_name = $request->input('j');
      $tagg->save();
      return 'ok';
  }



}
