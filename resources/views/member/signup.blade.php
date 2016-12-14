@extends('layouts.main')
@section('content')
	<div class="container">
		<div class="row">
			<div class="col s10 m10 l10" class="center">
				<div class="Signup-card">
					<div class="Signup-head">
						<div class="Signup-title">
							REGISTER
							<div class="Signup-body">
								<div class="Signup-inbody">
									<div class="Signup-details">
										 <div class="Signuprow">
    										<form class="col s12" method="post" action="{{ route('member.signup') }}" id='form-signup'>
      											<div class="Signuprow">
       	 											<div class="input-field col s12">
         	 											<input  id="username" type="text" class="validate" name="username" value="{{Request::old('username')}}">
          												<label for="username">USERNAME</label>

        											</div>
															<div class="red-text" id='error_username'>{{$errors->first('username')}}</div>
       	 										</div>
														<div class="Signuprow">
															<div class="input-field col s12">
																<input id="email" type="email" class="validate" name="email" value="{{Request::old('email')}}">
																<label for="email">EMAIL</label>
															</div>
															<div class="red-text" id='error_email' style="margin-top:10px; width:200px;">{{$errors->first('email')}}</div>
														</div>
      													<div class="input-field col s12">
          												<input id="password" type="password" class="validate" name="password" value="{{ Request::old('password') }}">
          												<label for="password">PASSWORD</label>
																	<div class="red-text" id='error_password'>{{$errors->first('password')}}</div>
        												</div>


      											<div class="signup">
       													<button type="submit" class="btn waves-effect waves-light" type="signup" name="action">SIGN UP</button>
  																<div class="back">

  													</div>
       										</div>
													<input type="hidden" name="_token" value="{{ Session::token() }}" >
											</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
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
