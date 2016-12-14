@extends('layouts.main')
@section('content')

<form role="form" method="post" action="{{ route('tests')}}">
  <input type="hidden" value="{{$id}}" name="hiddenidclub">
  <div class="form-group">
    <input class="form-control" name="topic_club_name" value="{{Request::old('topic_club_name')}}" required></input>
    <div class="text-danger" id='error_topic_club_name'>{{$errors->first('topic_club_name')}}</div>
  </div>
  <div class="form-group">
    <textarea class="form-control" name="body_club_name" value="{{Request::old('body_club_name')}}"></textarea>
    <div class="text-danger" id='error_body_club_name'>{{$errors->first('body_club_name')}}</div>
  </div><br>
  <button type="submit" class="btn btn-success">ตกลง</button>
  <input type="hidden" name="_token" value="{{ Session::token() }}">
</form>

<script>
tinymce.init({
  selector:'textarea',
  height: 350,
});
</script>
@stop
