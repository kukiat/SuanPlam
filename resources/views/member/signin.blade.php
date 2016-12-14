@extends('layouts.main')
@section('content')

<div class="container">
		<div class="row">
			<div class="col s12 m10 l10 offset-l1 offset-m1 ">
				<div class="card-panel deep-orange z-depth-3" style="text-align: center">
					<span class="Login-title  white-text">LOGIN</span>
				</div>
				<div class="card-panel lighten-4 z-depth-3" style="margin-top:-14px">
				<div class="row">
					<form class="col s12" action="{{ route('member.signin') }}" method="post">
						<div class="row">
							<div class="input-field col s6 offset-s3 {{ $errors->has('email') ? ' has-error' : '' }}" >
					          <input id="email" type="email" class="validate" name="email">
					          <label for="email">Email</label>
										@if ($errors->has('email'))
					            <div class="red-text" >{{ $errors->first('email') }}</div>
					          @endif
					    </div>

					    </div>
					    <div class="row">
					    	<div class="input-field col s6 offset-s3 {{ $errors->has('password') ? ' has-error' : '' }}">
					          <input id="password" type="password" class="validate" name="password">
					          <label for="password">Password</label>
										@if ($errors->has('password'))
					            <div class="red-text">{{ $errors->first('password') }}</div>
					          @endif
					        </div>
					    </div>
							<div class="col s11">
						    <div class="col s6 offset-s5">
						      <button class="btn waves-effect waves-light" type="submit" >Submit</button>
                  <button class="btn waves-effect waves-light" type="button" ><a href="{{route('member.signup')}}">Signup</a></button>
						    </div>
						  </div>
							<input type="hidden" name="_token" value="{{ Session::token() }}">
					</form>


				</div>
				</div>
			</div>
		</div>
	</div>
@stop
