@extends('layouts.main')
@section('content')

@if(Auth::check())
  @if((Auth::user()->type) == 'admin')
    <div class="col-md-1">
      เพิ่มวิชาของadmin
      <form method="post" id="addclub">
        <input type="text" id="nameclub" name="nameclub" class="form-control">
        <button type="submit">ตกลง</button>
        <input type="hidden" name="_token" value="{{ Session::token() }}">
      </form>
    </div>
    @endif
  @endif
  <div class="row">
  @foreach($clubmain as $clubmainn)
    <div class="col-md-3">
      <a href="{{ route('getpage.getpage',['club'=> $clubmainn->id ]) }}">{{ $clubmainn->club_name }}</a>
    </div>


  @endforeach
  </div>
<script>
  $(document).ready(function(){
    $('#addclub').submit(function(){
      var nameclub = $('#nameclub').val();
      alert(nameclub)
      $.ajax({
        url:"{{ route('postaddname') }}",
        type:"POST",
        data:{nameclub:nameclub,_token:  "{{ Session::token() }}"},
        success:function(data){
          alert(data)
        }
      })
      return false;
    })
  })
</script>
@stop
