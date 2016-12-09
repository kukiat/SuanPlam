<?php
namespace App\Http\Controllers;

use Auth;
use App\Models\member_user;
use App\Models\Status;
use App\Models\comment;
use App\Models\tag;
use App\Models\posttag;
use App\Models\commentcomment;
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
    $commentcomment = commentcomment::where('blog_commentincomment_id', '=', $blog)->get();
    //เช็ค if มี blog นั้นจริงๆหรทอป่าว แต่ยังไม่ทำ

      return view('feed.showw')
      ->with('val', $val)
      ->with('blog', $blog)
      ->with('send', $send)
      ->with('posttag',$posttag)
      ->with('commentcomment',$commentcomment);



  }
  public function postComment(Request $request,requestcomment $formulario,$blog){
      //post ajax ของหน้า comment
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
  }
  public function createtopic(){
    $tag = tag::get();
    return view('feed.createtopic')->with('tag',$tag);
  }
  public function replyinreplyy(Request $request){
    $id = $request->input('id');
    $body = $request->input('body');
    $blog = $request->input('blog');
    $idid = 5;
    $xxxt = new commentcomment([
      'member_commentincomment_id' => Auth::user()->id,
      'comment_commentincomment_id' => $id,
      'blog_commentincomment_id' => $blog,
      'body' => $body,
    ]);
    $xxxt->save();
    $res = commentcomment::where('id','=',$xxxt->id)->first();
    $ress = member_user::where('id','=',$xxxt->member_commentincomment_id)->first();
    return response()->json(array('res'=>$res,'ress'=>$ress));
  }
  public function addcageory(Request $request){
      //admin สร้างแท็ก
      $tagg = new tag;
      $tagg->tag_name = $request->input('j');
      $tagg->save();
      return 'ok';
  }
  public function getTag($tag_id){
    $posttag = posttag::where('tag_id','=',$tag_id)->get();
    $posttags = posttag::where('tag_id','=',$tag_id)->first();

    return view('tag.tagshow')->with('posttag',$posttag)->with('posttags',$posttags);
  }
}
