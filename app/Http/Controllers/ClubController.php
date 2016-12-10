<?php
namespace App\Http\Controllers;

use Auth;
use App\Models\member_user;
use App\Models\Status;
use App\Models\section;
use App\Models\comment;
use App\Models\subject;
use App\Models\clubmain;
use App\Models\commentinclassroom;
use App\Models\norequest;
use App\Models\yesrequest;
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

      return view('club.showclub')->with('club',$club);
    }
    public function postrequestsubmit(Request $request){//ขอสร้างชมรม แต่ไม่โดนปติเสด
      $id = $request->input('id');
      $active =1;
      $edited = clubmain::where('id', $id)->update(['active' => $active]);
      return 'เพิ่มเข้าแล้ว';
    }
    public function postrequestreject(Request $request){  //ขอสร้างชมรม แต่โดนปติเสด
      $id = $request->input('id');
      $edited = clubmain::where('id', $id)->delete();
      return'ยกเลิกไปแล้ว';
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
        return'รอก่อนใใจเยนๆ';
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


}
