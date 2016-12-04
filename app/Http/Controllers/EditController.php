<?php
namespace App\Http\Controllers;

use Auth;
use App\Models\member_user;
use App\Models\Status;
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


}
