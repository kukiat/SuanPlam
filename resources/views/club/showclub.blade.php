@extends('layouts.main')
@section('content')
  @if(Auth::check())
    @if(Auth::user()->type == 'user')
      @if($check)
        <a class="btn btn-primary" href="{{ route('create.club',['id'=>$club]) }}">สร้างกระทู้อิอิ</a>
      @else
        <button type="button" name="button" onclick="gotorequest('{{ $club }}',{{ Auth::user()->id}})" class="btn btn-success">ขอเข้าชมรม</button>
      @endif
    @endif
  @endif
  <br>
  <h3><b>สมาชิกชมรมทั้งหมด</b><br></h3>
    @foreach($showmember as $showmembe)
      -<b>ชื่อ</b> {{ $showmembe->user->username }}
      <b>เข้าร่วมเมื่อ</b> {{ $showmembe->created_at }}<br>
    @endforeach
    <hr>
  <h3><b>กระทู้</b></h3><br>
    @foreach($showfeed as $showfee)
      <a  href="#" onclick="showfeedclub('{{ $showfee->body }}')">{{ $showfee->topic }}</a>
      <b>ชื่อคนโพส</b> {{ $showfee->user->username }}
      <b>เวลา </b>{{ $showfee->created_at->diffForHumans()}}
      <br><hr>
    @endforeach
    <div id="ttt">

    </div>
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
  function showfeedclub(data){
    $('#ttt').html(data)
  }
</script>
@stop
