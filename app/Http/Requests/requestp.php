<?php

namespace App\Http\Requests;
use App\Http\Requests\Request;

use App\Models\member_user;

class requestp extends Request{
  public function rules(){
        return [
          'studentid_name' => 'required|min:13',
          'faculty_name' => 'required',
          'department_name'  => 'required',
        ];
    }

    public function messages(){
        return [
          'studentid_name.required' => 'โปรดกรอกข้อมูลให้ครบถ้วน',
          'studentid_name.min' => 'ข้อมูลต้องมากกว่า 13 ตัวอักษร',
          'faculty_name.required' => 'โปรดกรอกข้อมูลให้ครบถ้วน',
          'department_name.required' => 'โปรดกรอกข้อมูลให้ครบถ้วน',


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
