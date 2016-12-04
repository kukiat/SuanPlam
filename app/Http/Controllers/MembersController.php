<?php
namespace App\Http\Controllers;

use Auth;
use App\Models\member_user;
use Illuminate\Http\Request;
use App\Http\Requests\requestja;
use Validator;
//use App\Http\Requests;

class MembersController extends Controller{


  public function getSignup(){
      return view('member.signup');
  }
  public function postSignup(Request $request,requestja $formulario){
    $validator = Validator::make(
      $formulario->all(),
      $formulario->rules(),
      $formulario->messages()
    );
    if ($validator->valid()){
      if ($formulario->ajax()){
        member_user::create([
          'email' => $request->input('email'),
          'username' => $request->input('username'),
          'password' => bcrypt($request->input('password')),
        ]);
        return response()->json(["valid" => true], 200);
      }
    }
  }

  public function getSignin(){
    return view('member.signin');
  }
  public function postSignin(Request $request){
    $this->validate($request, [
      'email' => 'required',
      'password' => 'required',
    ]);
    if(!Auth::attempt($request->only(['email','password']), $request->has('remember'))){
      return redirect()->back()->with('info','กรุณากรอกให้ถูกต้อง');
    }
    return redirect()->route('home')->with('info','เข้าสู่ระบบแล้ว');
  }

  public function getSignout(){
    Auth::logout();
    return redirect()->route('home');
  }
}
