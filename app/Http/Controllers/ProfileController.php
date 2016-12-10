<?php
namespace App\Http\Controllers;


use App\Http\Requests\requestp;
use App\Models\Status;
use Auth;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\member_user;
use App\Models\clubmain;
use App\Models\norequest;
use Image;
use Validator;
class ProfileController extends Controller{
  public function getProfile($num){
    // เช็คด้วยว่าถ้าหน้าไหนไปไม่ได้ ให้เออเร่ออ
    $check =0;
    $numprofile = member_user::where('id','=',$num)->get();
    $blogprofile = Status::where('member_id','=',$num)->orderBy('created_at', 'desc')->get();
    $clubrequest = clubmain::where('active','=',$check)->get();
    $norequest = norequest::get();
    // dd($clubrequest);
    return view('profile.showprofile')
      ->with('numprofile',$numprofile)
      ->with('clubrequest',$clubrequest)
      ->with('blogprofile',$blogprofile)
      ->with('norequest',$norequest)
      ->with('num',$num);
  }
  public function postProfile(Request $request,requestp $vidator){

    $vidaddtor = Validator::make(
      $vidator->all(),
      $vidator->rules(),
      $vidator->messages()
    );

    Auth::user()->update([
      'studentid_name' => $request->input('studentid_name'),
      'faculty_name' => $request->input('faculty_name'),
      'department_name'  => $request->input('department_name'),

    ]);

        // return redirect()->back();
    return response()->json(array('vali'=>true,'xx'=>  Auth::user()));
  }
  public function postavatar(Request $request){
    if($request->hasFile('avatar')){
        $avatar = $request->file('avatar');
        $filename = time() . '.' . $avatar->getClientOriginalExtension();
        Image::make($avatar)->resize(300, 300)->save( public_path('/avatar/' . $filename ) );
        $user = Auth::user();
        $user->avatar = $filename;
        $user->save();
      }
      return redirect()->back();
  }
}
