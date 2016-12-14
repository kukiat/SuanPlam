<?php
namespace App\Http\Controllers;
use Auth;
use Validator;
use App\Models\member_user;
use App\Models\Status;
use App\Models\section;
use App\Models\comment;
use App\Models\subject;
use App\Models\feedclub;
use App\Models\clubmain;
use App\Models\feedtag;
use App\Models\commentinclassroom;
use App\Models\norequest;
use App\Models\commentclub;
use App\Models\yesrequest;
use App\Http\Requests\requestvalidatecreateclub;
use Illuminate\Http\Request;
use App\Http\Requests;

class ClubController extends Controller{
    public function getmain(){
      $active =1;
      $clubmain = clubmain::where('active','=',  $active)->get();
      $feedrecent = feedclub::orderBy('created_at','desc')->paginate(10);
      return view('club.mainclub')->with('clubmain',$clubmain)->with('feedrecent',$feedrecent);
    }
    public function postaddname(Request $request){  //แอดมินสร้างวิชาเอง
      $name = $request->input('nameclub');
      $active = 1;

      $clubmain = new clubmain;
      $clubmain->club_name = $name;
      $clubmain->active = $active;
      $clubmain->detail = 'ku admin';
      $clubmain->member_request_id = Auth::user()->id;
      $clubmain->save();
      return 'ok';
    }
    public function postrequestuser(Request $request){  //ขอสร้างชมรมจากคนทั่วๆไป
      $namee = $request->input('clubnameopen');
      $detaill = $request->input('clubdetailopen');
      $tag_club = $request->input('tag_club');
      $active =0;
      $clubmain = new clubmain;
      $clubmain->club_name = $namee;
      $clubmain->active = $active;
      $clubmain->detail = $detaill;
      $clubmain->member_request_id = Auth::user()->id;
      $clubmain->save();
      for ($x = 0; $x < count($tag_club); $x++){
        $feedtag = new feedtag;
        $feedtag->club_id = $clubmain->id;
        $feedtag->tag_club_name = $tag_club[$x];
        $feedtag->active_tag = $active;
        $feedtag->save();
      }
      return redirect()->back();
    }
    public function pageeee($club){ //สร้างหน้าชมรมแต่ละชมรม
      $ismember=0;
      $main = clubmain::where('id','=',$club)->first();
      if(!count($main)){
        return redirect()->route('home');
      }
      $showfeed = feedclub::where('club_id','=',$club)->orderBy('created_at','desc')->get();
      $showmember = yesrequest::where('club_yesrequestclub_id','=',$club)->get();
      if(Auth::check()){
        $check = yesrequest::where('club_yesrequestclub_id','=',$club)->get();
        foreach ($check as $chec) {
          if($chec->member_yesrequestclub_id == Auth::user()->id)
            $ismember=1;
        }
      }
      return view('club.showclub')
      ->with('club',$club)
      ->with('check',$ismember)
      ->with('showfeed',$showfeed)
      ->with('showmember',$showmember)
      ->with('main',$main);
    }
    public function postrequestsubmit(Request $request){  //ขอสร้างชมรม แต่ได้
      $id = $request->input('id');
      $requestid = $request->input('requestid');
      $active =1;
      $edited = clubmain::where('id', $id)->update(['active' => $active]);
      $club = clubmain::where('id','=' ,$id)->first();
      $add = new yesrequest;
      $add->member_yesrequestclub_id = $requestid;
      $add->club_yesrequestclub_id = $club->id;
      $add->save();
      $oktag = feedtag::where('club_id','=',$club->id)->update(['active_tag' => $active]);
      return 'เพิ่มชมรมเข้าแล้ว';
    }
    public function postrequestreject(Request $request){  //ขอสร้างชมรม แต่โดนปติเสด
      $id = $request->input('id');
      $edited = clubmain::where('id', $id)->delete();
      $canceltag = feedtag::where('club_id','=',$id)->delete();
      return 'ยกเลิกชมรมแล้ว';
    }
    public function postrequestclubforother(Request $request){  //post form ของร้องขอสร้างชมรม
      $idclub = $request->input('id');
      $member = $request->input('member');
      $check = norequest::where([
        ['member_norequestclub_id','=',$member],
        ['club_norequestclub_id','=',$idclub],
      ])->first();
      if(empty($check)){
        $norequest = new norequest;
        $norequest->member_norequestclub_id = $member;
        $norequest->club_norequestclub_id = $idclub;
        $norequest->save();
        return 'ok';
      }else{
        return'ขอเข้าแล้ว รอก่อนใจเยนๆ';
      }
    }
    public function postsubmitrequestclub(Request $request){
      $id = $request->input('id');
      $get = norequest::where('id','=',$id)->first();
      $yesrequest = new yesrequest;
      $yesrequest->member_yesrequestclub_id = $get->member_norequestclub_id;
      $yesrequest->club_yesrequestclub_id = $get->club_norequestclub_id;
      $yesrequest->save();
      $delete = norequest::where('id','=',$id)->delete();
      return'ok';
    }
    public function postrejectrequestclub(Request $request){
      $id = $request->input('id');
      $delete = norequest::where('id','=',$id)->delete();
      return'ok';
    }
    public function postsubmitfriend(Request $request){
      $id = $request->input('id');
      $get = norequest::where('id','=',$id)->first();
      $yesrequest = new yesrequest;
      $yesrequest->member_yesrequestclub_id = $get->member_norequestclub_id;
      $yesrequest->club_yesrequestclub_id = $get->club_norequestclub_id;
      $yesrequest->save();
      $delete = norequest::where('id','=',$id)->delete();
      return'ok';
    }
    public function postrejectfriend(Request $request){
      $id = $request->input('id');
      $delete = norequest::where('id','=',$id)->delete();
      return 'ยกเลิกแล้ว';
    }
    public function createclub($id){
      $check = yesrequest::where([
        ['club_yesrequestclub_id','=',$id],
        ['member_yesrequestclub_id','=',Auth::user()->id],
      ])->get();
      if(!count($check)){
          return redirect()->route('home');
      }
      return view('club.createfeedclub')->with('id',$id);
    }
    public function postclubdetail(Request $request){
      $id = $request->input('id');
      $feedclub = feedclub::where('id','=',$id)->first();
      $commentfeedclub = commentclub::where('feedclub_clubcomment_id','=',$id)->get();
      $name=[];
      foreach($commentfeedclub as $commentfeedclu){
        $name[count($name)]=(member_user::where('id','=',$commentfeedclu->member_clubcomment_id)->get()[0]);
      }
      return response()->json(array('feedclub'=>$feedclub,'commentfeedclub'=>$commentfeedclub,'name'=>$name));
    }
    public function postcommentclub(Request $request){
      $text = $request->input('text');
      $id = $request->input('id');
      $comment = new commentclub;
      $comment->member_clubcomment_id = Auth::user()->id;
      $comment->feedclub_clubcomment_id =$id;
      $comment->body = $text;
      $comment->save();
      $name = member_user::where('id','=',$comment->member_clubcomment_id)->first();
      return response()->json(array('comment'=>$comment,'name'=>$name));
    }
    public function tests(Request $request){
      $topic = $request->input('topic_club_name');
      $body = $request->input('body_club_name');
      $clubid = $request->input('hiddenidclub');
      $feedclub = new feedclub;
      $feedclub->club_id = $clubid;
      $feedclub->member_id = Auth::user()->id;
      $feedclub->topic = $topic;
      $feedclub->body = $body;
      $feedclub->save();
      return redirect()->route('getpage.getpage',['club' => $clubid]);
    }
}
