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
use App\Models\commentinclassroom;
use App\Models\norequest;
use App\Models\yesrequest;
use App\Http\Requests\requestvalidatecreateclub;
//use App\Models\reply;
use Illuminate\Http\Request;
use App\Http\Requests;

class ClubController extends Controller{
    public function getmain(){
      $active =1;
      $clubmain = clubmain::where('active','=',  $active)->get();
      return view('club.mainclub')->with('clubmain',$clubmain);
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
      $namee = $request->input('clubname');
      $detaill = $request->input('clubdetail');
      $active =0;

      $clubmain = new clubmain;
      $clubmain->club_name = $namee;
      $clubmain->active = $active;
      $clubmain->detail = $detaill;
      $clubmain->member_request_id = Auth::user()->id;
      $clubmain->save();
      return 'ขอเปิดชมรมแล้ว กรุณารออนุมัติ';
    }
    public function pageeee($club){
      $ismember=0;
      $main = clubmain::where('id','=',$club)->get();
      if(!count($main)){
        return redirect()->route('home');
      }
      $showfeed = feedclub::where('club_id','=',$club)->get();
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
      ->with('showmember',$showmember);
    }
    public function postrequestsubmit(Request $request){  //ขอสร้างชมรม แต่ไม่โดนปติเสด
      $id = $request->input('id');
      $requestid = $request->input('requestid');
      $active =1;
      $edited = clubmain::where('id', $id)->update(['active' => $active]);
      $club = clubmain::where('id','=' ,$id)->first();
      $add = new yesrequest;
      $add->member_yesrequestclub_id = $requestid;
      $add->club_yesrequestclub_id = $club->id;
      $add->save();
      return 'เพิ่มชมรมเข้าแล้ว';
    }
    public function postrequestreject(Request $request){  //ขอสร้างชมรม แต่โดนปติเสด
      $id = $request->input('id');
      $edited = clubmain::where('id', $id)->delete();
      return 'ยกเลิกชมรมแล้ว';
    }
    public function postrequestclubforother(Request $request){
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
    public function postcreateclub(Request $request,requestvalidatecreateclub $vid){
      $vidaddtor = Validator::make(
        $vid->all(),
        $vid->rules(),
        $vid->messages()
      );
      $topic = $request->input('topic_club_name');
      $body = $request->input('body_club_name');
      $clubid = $request->input('hiddenid');

      $feedclub = new feedclub;
      $feedclub->club_id = $clubid;
      $feedclub->member_id = Auth::user()->id;
      $feedclub->topic = $topic;
      $feedclub->body = $body;
      $feedclub->save();
      // feedclub::create([
      //   'club_id' => $clubid,
      //   'topic' => $topic,
      //   'body' => bcrypt($request->input('password')),
      // ]);
      return response()->json(array('check'=>true));

    }

}
