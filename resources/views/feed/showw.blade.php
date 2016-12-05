@extends('layouts.main')
@section('content')

<div class="container">
  <div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-10">
      @foreach($val as $vall)    <!--   TOPIC-->
        <h1 style="text-align:center;color:#03a9f4;"><b>{{ $vall->topic }}</b></h1>
        <hr>
        <h2 style="font-size: 2em;">{!! str_limit($vall->body,2000) !!}</h2>

        <div style="text-align:center;">
          <img class="img-circle img-responsive" src="/avatar/{{ $vall->member_userr->avatar }}" style="weight:75px; height:75px;margin-left:440px;margin-top:50px;"/>
          <h4 >Posted By  <a href="{{route('profile.profile',['num' => $vall->member_id])}}">{{$vall->member_userr->username}}</a></h4>
          <h6 >{{ $vall->created_at->diffForHumans() }}</h6>

        </div>
        
        <span class="label label-default">ทั่วไป</span>
        <span class="label label-info">ท่องเที่ยว</span><br>

        @if(Auth::check())
          @if((Auth::user()->id)==($vall->member_id))
            <a href="#">แก้ไข</a>
          @endif
        @endif
      @endforeach
    </div>
    <div class="col-md-1"></span></div>
  </div><hr>


  <div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-10">
    <h3><b>Comment </b></h3>
    <div id="add">
       @foreach($send as $sendd)                <!--   comment -->
          <div class="list-group" >
            <div  class="list-group-item">
              <img class="img-circle img-responsive" src="/avatar/{{ $sendd->userrrr->avatar }}" style="weight:75px; height:75px; float:left;margin-right:12px;"/>
              <a href="{{ route('profile.profile',['num'=>$sendd->member_comment_id])}}" target="_blank"><h3 class="list-group-item-heading"><b>{{ $sendd->userrrr->username }}</b></h3></a>
              <p class="list-group-item-text">
                <h4 id="xxsx">{{ $sendd->body }}</h4>
                <h6>{{ $sendd->created_at->diffForHumans()}}</h6>
                @if(Auth::check())
                  @if((Auth::user()->id)==($sendd->member_comment_id))
                    <a href="#" style="float:right; margin-top:-90px;" data-toggle="modal" data-target="#edit-comment" onclick="ggg('{{ $sendd->body }}','{{ $sendd->id }}')">แก้ไข</a>
                  @endif

                @endif
                <!-- <a onclick="showcomment_in_comment({{ $sendd->id }})">
                    ตอบกลับ
                </a> -->
              </p>
            </div>
          </div>

          @endforeach
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-4">
        <form method="post" action="{{ route('comment.comment',['blog' => $blog]) }}" id="form_comment">

          <div class="form-group">
            <textarea class="form-control" rows="3" name="textcomment" value="{{Request::old('textcomment')}}"></textarea>

            <div class="text-danger alal" id='error_textcomment'>{{$errors->first('textcomment')}}</div>
          </div>

          <div class="form-group">
            <!-- <button type="submit" class="btn btn-success">ตกลง</button> -->
            <input type="submit" name="name" value="ตกลง" class="btn btn-primary">
          </div>
          <input type="hidden" name="_token" value="{{ Session::token() }}">
        </form>
      <div class="col-md-8"></div>
    </div>
  </div><hr>

</div>
<!-- modal edit -->
<div id="show_modal_edit"></div>
<!-- end model edit -->

<script>
  $(document).ready(function(){
    $("#form_comment").submit(function(e){
        var fields = $('#form_comment').serialize();
        // console.log(fields)
            $.post("{{ route('comment.comment',['blog' => $blog]) }}", fields, function(data){
            // console.log(data);
            if(data.vv !== undefined){
              $("#form_comment")[0].reset();
              $("#error_textcomment").html('');
              var str='';
              if(((data.xx).id)==((data.vv).member_comment_id)){
                str = '<a href="#" style="float:right; margin-top:-90px;" data-toggle="modal" data-target="#edit-comment" onclick="ggg(\'' + (data.vv).body + '\',\'' + (data.vv).id + '\')">'+'แก้ไข'+'</a>'
              }
              $('#add').append('<div class="list-group">'+
                '<div  class="list-group-item">'+
                  '<img src="/avatar/'+(data.xx).avatar+'" class="img-circle img-responsive"  style="weight:75px; height:75px; float:left;margin-right:12px;"/>'+
                    '<a  href="/profile/'+(data.xx).id+'" target="_blank">'+'<h3 class="list-group-item-heading">'+'<b>'+(data.xx).username+'</b>'+'</h3>'+'</a>'+
                      '<p class="list-group-item-text">'+
                      '<h4>'+(data.vv).body+'</h4>'+
                      '<h6>'+'1 second ago'+'</h6>'+  str
                          +'</p>'+
                '</div>'+
              '</div>');

              }
              else {    //ไม่ผ่าน
                  $("#error_textcomment").html('');

                  if (data.textcomment !== undefined){
                      $("#error_textcomment").html(data.textcomment);
                  }
              }
            });
            return false;
      });
    });
  function ggg(data,data2){
    $('#show_modal_edit').html('<div class="modal fade" id="edit-comment" role="dialog">'+
      '<div class="modal-dialog modal-lg">'+
        '<div class="modal-content">'+
          '<div class="modal-header">'+
            '<h4 class="modal-title">'+'แก้ไข'+'</h4>'+
          '</div>'+
          '<div class="modal-body">'+
            '<div class="row">'+
            '<form id="edit-comment-ajax" method="POST">'+
                '<div id="idid" name="idja"></div>'+
                  '<div class="col-md-12">'+
                      '<textarea type="text" class="form-control" id="text-comment" rows="4" name="commenddd" value="+oh+" autofocus>'+'</textarea>'+'<br>'+
                  '</div>'+
              '<div class="col-md-12">'+
                '<button type="submit" class="btn btn-success">'+'แก้ไข'+'</button>'+
              '</div>'+
              '<input type="hidden" name="_token" value="{{ Session::token() }}">'+
              '</form>'+
            '</div>'+
          '</div>'+
        '</div>'+
      '</div>'+
    '</div>');
    $('#text-comment').html(data)

    $("#edit-comment-ajax").submit(function(){
      // var ss = $('#edit-comment-ajax').serialize();
      var dd = $('#text-comment').val();
      $.ajax({
        url:"{{ route('comment.edit') }}",
        type:"POST",
        data:{topic:dd,id:data2,_token:  "{{ Session::token() }}"},
        success:function(data){
          $('#edit-comment').modal('hide');
          // $('#xxsx').html(data.topic)


          // console.log($('#ddddd').attr("id"))
        }
      });
       return false;
    });
  }
</script>

@stop
