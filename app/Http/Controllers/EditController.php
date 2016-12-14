<?php
namespace App\Http\Controllers;

use Auth;
use Image;
use App\Models\member_user;
use App\Models\Status;
use App\Models\clubmain;
use App\Models\comment;
use Illuminate\Http\Request;
//use App\Http\Requests;

class EditController extends Controller{
    public function editcomment(Request $request){
      $topic = $request->input('topic');
      $id = $request->input('id');
      $edited = comment::where('id', $id)->update(['body' => $topic]);

      return response()->json(array('topic'=>$topic,'id'=>$id));
    }
    public function editclubpic(Request $request){
      $id = $request->input('hiddenclub');
      if($request->hasFile('avatarclub')){
          $avatar = $request->file('avatarclub');
          $filename = time() . '.' . $avatar->getClientOriginalExtension();
          Image::make($avatar)->resize(300, 300)->save( public_path('/avatar/' . $filename ) );
          $edited = clubmain::where('id', $id)->update(['avatar' => $filename]);
        }
        return redirect()->back();
    }

}
