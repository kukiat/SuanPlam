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
//use App\Models\reply;
use Illuminate\Http\Request;
use App\Http\Requests;

class ClubController extends Controller{
    public function getmain(){
      $active =1;
      $clubmain = clubmain::where('active','=',  $active)->get();
      return view('club.mainclub')->with('clubmain',$clubmain);
    }
    public function postaddname(Request $request){  //สำหรับ comment
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
    public function postrequestuser(Request $request){
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
      return view('club.showclub');
    }
    public function postrequestsubmit(Request $request){
      $id = $request->input('id');
      $active =1;
      $edited = clubmain::where('id', $id)->update(['active' => $active]);
      return 'เพิ่มเข้าแล้ว';
    }
    public function postrequestreject(Request $request){
      $id = $request->input('id');
      
      $edited = clubmain::where('id', $id)->delete();;
      return'ยกเลิกไปแล้ว';
    }


}
