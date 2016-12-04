<?php

namespace App\Http\Requests;
use App\Http\Requests\Request;
use App\Models\member_user;
class requestja extends Request{
  public function rules(){
        return [
            'username' => 'required|min:3|max:12|unique:members',
            'email' => 'required|email|unique:members',
            'password' => 'required|min:6|max:12',

        ];
    }

    public function messages(){
        return [
            'username.unique' => 'ชื่อนี้มีผู้อื่นใช้งานแล้ว',
            'username.required' => 'โปรดกรอกข้อมูลให้ครบถ้วน',
            'username.min' => 'ข้อมูลต้องมากกว่า 3 ตัวอักษร',
            'username.max' => 'ข้อมูลต้องต้องไม่เกิน 12 ตัวอักษร',
            'email.required' => 'โปรดกรอกข้อมูลให้ครบถ้วน',
            'email.email' => 'โปรดกรอกข้อมูลให้ถูกต้อง(Ex. @hotmail.com,@gmail.com)',
            'email.unique' => 'ชื่อนี้มีผู้อื่นใช้งานแล้ว',
            'password.required' =>'โปรดกรอกข้อมูลให้ครบถ้วน',
            'password.min' => 'ข้อมูลต้องมากกว่า 6 ตัวอักษร',
            'password.max' => 'ข้อมูลต้องต้องไม่เกิน 12 ตัวอักษร',


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
