@extends('layouts.main')
@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-4 box">
        <div class="btn-group">
          <select class="dropdown-department" id="select">
            <option value="0">All</option>
            <option value="01">คณะวิศวกรรมศาสตร์</option>
            <option value="02">คณะครุศาสตร์อุตสาหกรรม</option>
            <option value="03">วิทยาลัยเทคโนโลยีอุตสาหกรรม</option>
            <option value="04">คณะวิทยาศาสตร์ประยุกต์</option>
            <option value="05">คณะอุตสาหกรรมเกษตร</option>
            <option value="06">คณะเทคโนโลยีและการจัดการอุตสาหกรรม</option>
            <option value="07">คณะเทคโนโลยีสารสนเทศ</option>
            <option value="08">คณะศิลปศาสตร์ประยุกต์</option>
          </select><br>
          <select class="dropdown-department oo">
            <option value="0">All</option>
          </select><br>
          <input id="search" type="text" class="search" placeholder="Search">
          <span id="clear" class="clear_textSearch searchclear" style="z-index:1000;display:block;">x</span>
        </div>
        <!-- <span class="glyphicon glyphicon-search" style="margin-left:10px;margin-bottom:10px"></span> -->
        <div class="row" style="background-color:#F6F7F8;overflow-y:auto; margin:5px;height:500px;">
          <div class="list-group shower">
            @foreach($yoyo as $yoyo)
              <div class="list-group-item bb" onclick="detail('{{ $yoyo->code }}')"style="margin-top:7px;margin-left:8px;margin-right:10px;cursor:hand;font-size:15px;">{{ $yoyo->code }} <br>{{ $yoyo->name }}</div>
            @endforeach
          </div>
        </div>
      </div>

      <div class="col-md-8" >
        <div style="background-color:#ff7300;margin: 2px 0px 30px 5px;padding-bottom:23px;border: thin solid black; text-align: center;"><h4 id="show"></h4></div>
        <div class="row" style="height:560px;overflow-y:auto; border: thin solid black; padding-left:20px;margin:5px;margin-top:30px;background-color:#F6F7F8;">
          <table class="table" id="showw" >

            <tr><h4 id="show2"></h4></tr>
            <tr><h4 id="show3"></h4></tr>
            <tr> <h4 id="show4"></h4></tr>
            <tr><div class="showw1"></div></tr>


            @if(Auth::check())
              <tr><div id="comment_class"></div></tr>
            @endif
            <tr><div id="btnn"></div></tr>
            <tr><div class="show_comment" ></div></tr>
          </table>
        </div>
      </div>
    </div>
  </div>

  <!-- MODAL -->
  <div class="modal fade" id="showdetail" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">แสดงความคิดเห็น</h4>
        </div>
        <div class="modal-body">
          <h2 id="sho">วิชา</h2>
          <div id="addddd"></div>
          <div id="comm"></div>
          <form method="POST" id="fff" action="{{ route('ggggggge') }}" >
            <textarea id="commentclass" class="form-control" rows="3"></textarea><br>

            <button class="btn btn-success" type="submit">ตกลง</button>
            <input type="hidden" name="_token" value="{{ Session::token() }}">
          </form>
        </div>

      </div>

    </div>
</div>
<script>
  $(document).ready(function(){

    $('#fff').submit(function(){
      var id = $('#addddd').text()
      var x = $('#commentclass').val()
      var section = $('#section_number').text();

      console.log(id)
      $.ajax({
        type:"POST",
        url:"{{ route('ggggggge') }}",
        data:{x:x,id:id,section:section,_token: "{{ Session::token() }}"},
        success:function(data){
          $('#comm').append('<h1>'+data.id+data.section+'</h1>'+'<h1>'+data.x+'</h1>')
        }
      });
      return false;
    });
    $(document).on('submit','#submit_comment_class',function(){
      var id = $('#show3').text();
      var body = $('#comment_text_class').val()

      $.ajax({
        type:"POST",
        url:"{{ route('comment.class') }}",
        data:{id:id,body:body,_token: "{{ Session::token() }}"},
        success:function(data){
          console.log(data.comment)
          $('.show_comment').append('name :'+'<br>'+'body :'+(data.comment).body+'<hr>')
        }
      })
      return false;
    });
  });
</script>
<!-- END MODAL -->
@stop
