@extends('layouts.main')
@section('content')
  <div class="row">
    <div class="col-ms-6">
      <h1>เข้าสู่ระบบ</h1>
      <form class="form-vertical" action="{{ route('member.signin') }}" method="post">
        <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}" >
          <label for="email" class="control-label">E-mail : </label>
          <input type="text" name="email" class="form-control" id="email" style="width: 260px;">
          @if ($errors->has('email'))
            <span class="help-block">{{ $errors->first('email') }}</span>
          @endif
        </div>
        <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
          <label for="password" class="control-label">password : </label>
          <input type="password" name="password" class="form-control" id="password" style="width: 260px;">
          @if ($errors->has('password'))
            <span class="help-block">{{ $errors->first('password') }}</span>
          @endif
        </div>
        <div class="checkbox">
          <label><input type="checkbox" name="remember">Remember</label>
        </div>
        <div class="form-group">
          <button type="submit" class="btn btn-default">sign up</button>
        </div>
        <input type="hidden" name="_token" value="{{ Session::token() }}">
      </form>
    </div>
  </div>
@stop
