<?php

namespace App\Http\Requests;
use App\Http\Requests\Request;

class requestcomment extends Request{
  public function rules(){
        return [

            'textcomment' => 'required|max:200',
        ];
    }

    public function messages(){
        return [
            'textcomment.required' => 'กรุณากรอกข้อมูล',
            'textcomment.max' => 'ห้ามเกิน200ข้อความ',

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
