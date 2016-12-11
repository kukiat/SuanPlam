@extends('layouts.main')
@section('content')

<form role="form" method="post" id="createfeedsub">
  <input type="hidden" value="{{$id}}" name="hiddenid">
  <div class="form-group">
    <input class="form-control" name="topic_club_name" value="{{Request::old('topic_club_name')}}"></input>
    <div class="text-danger" id='error_topic_club_name'>{{$errors->first('topic_club_name')}}</div>
  </div>
  <div class="form-group">
    <textarea class="form-control" id="summerja" name="body_club_name" value="{{Request::old('body_club_name')}}"></textarea>
    <div class="text-danger" id='error_body_club_name'>{{$errors->first('body_club_name')}}</div>
  </div>
  <button type="submit" class="btn btn-success">ตกลง</button>
  <input type="hidden" name="_token" value="{{ Session::token() }}">
</form>

<script>
$(document).ready(function() {
  $('#summerja').summernote({
    height: 300,
    minHeight: null,
    maxHeight: null,
    focus: true
  });
});
$('#createfeedsub').submit(function(){

  var dds = $('#createfeedsub').serialize();
  $.post("{{ route('postcreateclub') }}",dds, function(data){
    console.log(data.check)
    if(data.check != undefined){
      window.location = "/club";
    }
    else{    //ไม่ผ่าน
      $("#error_topic_club_name").html('');
      $("#error_body_club_name").html('');

      if (data.topic_club_name !== undefined){
          $("#error_topic_club_name").html(data.topic_club_name);
      }
      if (data.body_club_name !== undefined){
          $("#error_body_club_name").html(data.body_club_name);
      }
    }
  });
  return false;
})
</script>
@stop
