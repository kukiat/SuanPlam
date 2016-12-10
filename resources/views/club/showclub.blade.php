@extends('layouts.main')
@section('content')

    <button type="button" name="button" onclick="gotorequest('{{ $club }}',{{ Auth::user()->id}})" class="btn btn-success">ขอเข้าชมรม</button>
    ข่าวสารต่างๆๆ

<script>
  function gotorequest(clubid,memberid){
    var id = clubid;
    var member = memberid;
    $.ajax({
      url:"{{ route('postrequestclubforother') }}",
      type:"POST",
      data:{id:id,member:member,_token:  "{{ Session::token() }}"},
      success:function(data){
        alert(data)
      }
    })
    return false;
  }
</script>
@stop
