<?php

namespace App\Http\Requests;
use App\Http\Requests\Request;

use App\Models\member_user;

class requestvalidatecreateclub extends Request{
  public function rules(){
        return [
          'topic_club_name' => 'required|max:50',
          'body_club_name' => 'required|max:5000',
        ];
    }

    public function messages(){
        return [
          'topic_club_name.required' => 'โปรดกรอกข้อมูลให้ครบถ้วน',
          'body_club_name.required' => 'โปรดกรอกข้อมูลให้ครบถ้วน',
          'topic_club_name.max' => 'ข้อมูลต้องไม่เกิน 50 ตัวอักษร',
          'body_club_name.max' => 'ข้อมูลต้องไม่เกิน 5000 ตัวอักษร',
        ];
    }

    public function response(array $errors){
        if ($this->ajax()){
            return response()->json($errors, 200);
        }
    }

    public function authorize(){
        return true;
    }

}
