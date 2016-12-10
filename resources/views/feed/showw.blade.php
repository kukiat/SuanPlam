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
          <h4 >Posted By  <a href="{{route('profile.profile',['num' => $vall->member_id])}}">{{ $vall->member_userr->username }}</a></h4>
          <h6 >{{ $vall->created_at->diffForHumans() }}</h6>

        </div>
        <span class="glyphicon glyphicon-duplicate"></span><span class="label label-default">{{$vall->category}}</span>
        <span class="glyphicon glyphicon-tags"></span>
        @foreach($posttag as $posttag)
          <a href="{{ route('getTag',['tag_id' => $posttag->tag_id])}}"><span class="label label-info">{{ $posttag->tags->tag_name }}</span></a>
        @endforeach
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
          <div class="list-group" id="{{ $sendd->id }}">
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
              </p>
              @if(Auth::check())
                <a href="#" onclick="replyreply('{{ $sendd->id }}','{{ $sendd->statused->id}}')" data-toggle="modal" data-target="#reply-reply">Reply</a>
              @endif
            </div>

            @foreach($commentcomment as $commentcommen)
              @if(($commentcommen->comment_commentincomment_id) == ($sendd->id))

                  <p>name : {{ $commentcommen->members->username}}</p>
                  picture:<img class="img-circle img-responsive" src="/avatar/{{ $commentcommen->members->avatar }}" style="weight:15px; height:15px;"/>
                  <p>text :{{ $commentcommen->body }}</p>
                  <p>time :{{ $commentcommen->created_at->diffForHumans()}}</p><hr>

              @endif
            @endforeach

          </div>

          @endforeach
      </div>
    </div>
  </div>

  <!-- form สำหรับกรอก -->
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
<div id="show-reply-reply"></div>
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
              $('#add').append('<div class="list-group" id="' + (data.vv).id + '">'+
                '<div  class="list-group-item">'+
                  '<img src="/avatar/'+(data.xx).avatar+'" class="img-circle img-responsive"  style="weight:75px; height:75px; float:left;margin-right:12px;"/>'+
                    '<a  href="/profile/'+(data.xx).id+'" target="_blank">'+'<h3 class="list-group-item-heading">'+'<b>'+(data.xx).username+'</b>'+'</h3>'+'</a>'+
                      '<p class="list-group-item-text">'+
                      '<h4>'+(data.vv).body+'</h4>'+
                      '<h6>'+'1 second ago'+'</h6>'+  str
                          +'</p>'+
                            '<a href="#" onclick="replyreply(\'' + (data.vv).id + '\',\'' + (data.vv).blog_comment_id + '\')" data-toggle="modal" data-target="#reply-reply">'+'Reply'+'</a>'+
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
        }
      });
       return false;
    });

  }
  function replyreply(data,data2){
    $('#show-reply-reply').html('<div id="reply-reply" class="modal fade" role="dialog">'+
  '<div class="modal-dialog">'+


    '<div class="modal-content">'+
      '<div class="modal-header">'+
        '<button type="button" class="close" data-dismiss="modal">&times;</button>'+
        '<h4 class="modal-title">'+'ตอบกลับ'+'</h4>'+
      '</div>'+
      '<div class="modal-body">'+
        '<form id="reply-reply-submit" method="post">'+
          '<textarea id="reply-reply-text" class="form-control"  rows="2" >'+'</textarea>'+
          '<button type="submit" class="btn btn-danger op">'+'ตกลง'+'</button>'+
          '<input type="hidden" name="_token" value="{{ Session::token() }}">'+
        '</form>'+
      '</div>'+
      '<div class="modal-footer">'+
      '  <button type="button" class="btn btn-default" data-dismiss="modal">'+'Close'+'</button>'+
      '</div>'+
    '</div>'+

  '</div>'+
'</div>');
$('#reply-reply-submit').submit(function(){
  var id = data;
  var blog = data2;
  var body = $('#reply-reply-text').val()

  $.ajax({
    type:"POST",
    url:"{{ route('replyinreply') }}",
    data:{id:id,blog:blog,body:body,_token:  "{{ Session::token() }}"},
    success:function(data){
      $('#reply-reply').modal('hide');
        var x = (data.res).comment_commentincomment_id;
        $('#'+id).append('<h1>'+(data.ress).username+'</h1>'+'<h1>'+(data.res).body+'</h1>')
    }
  });
  return false;
})

}

</script>

@stop
