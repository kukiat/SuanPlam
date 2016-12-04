@extends('layouts.main')
@section('content')


<form method="post" action="{{ route('member.signup') }}" id='form-signup'>
    <div class="form-group">
        <label >Name: </label>
        <input type="text" name="username" class="form-control" style="width: 260px;" value="{{Request::old('username')}}" />
        <div class="text-danger" id='error_username'>{{$errors->first('username')}}</div>
    </div>

    <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
        <label >Email: </label>
        <input type="text" name="email" class="form-control" style="width: 260px;" value="{{Request::old('email')}}" />
        <!-- <div class="text-danger" id='error_email'>{{$errors->first('email')}}</div> -->
        <div class="alert-danger" id='error_email' style="margin-top:10px; width:200px;">{{$errors->first('email')}}</div>
    </div>
    <div class="form-group">
        <label >Password: </label>
        <input type="password" name="password" class="form-control" style="width: 260px;" value="{{Request::old('password')}}" />
        <div class="text-danger" id='error_password'>{{$errors->first('password')}}</div>
    </div>
    <input type="hidden" name="_token" value="{{ Session::token() }}" >
    <button type="submit" class="btn btn-primary">ตกลง</button id="ok">
</form>

<script>
 $(function(){
    //  $("#form").submit(function(e){
       $("#form-signup").submit(function(e){

           var fields = $('#form-signup').serialize();
           $.post("{{ route('member.signup') }}", fields, function(data){
              console.log(data.valid);
               if(data.valid == true){

                   $("#form-signup")[0].reset();
                   $("#error_username").html('');
                   $("#error_email").html('');
                   $("#error_password").html('');
                   swal("", "สมัครสมาชิกแล้ว", "success")
               }
               else {    //ไม่ผ่าน
                   $("#error_username").html('');
                   $("#error_email").html('');
                   $("#error_password").html('');
                   if (data.username !== undefined){
                      $("#error_username").html(data.username);
                   }
                   if (data.email !== undefined){
                       $("#error_email").html(data.email);
                   }
                   if (data.password !== undefined){
                       $("#error_password").html(data.password);
                   }
               }

           });

           return false;


     });
 });
</script>

@stop
