@extends('layouts.main')
@section('content')
	<div class="container main">
	    <div class="row">
	    	<div class="col s12 m12 l10 offset-l1 new-content">
					@foreach($val as $vall)
		    		<div class="center-align new-header">
		    			<h3>{{ $vall->topic }}</h3>
		    		</div>
		    		<div class="new-content">
		    			{!! str_limit($vall->body,20000) !!}
		    		</div>
		    		<div class="new-profile">
		    			<center><img src="/avatar/{{ $vall->member_userr->avatar }}" width="100" height="100" style="border-radius: 50%"></center>
		    			<div class="center-align"><a href="{{route('profile.profile',['num' => $vall->member_id])}}">{{ $vall->member_userr->username }}</a></div>
		    			<div class="center-align time">{{ $vall->created_at->diffForHumans() }}</div>
		    		</div>
            <div class="tagandcat">
		    		<div class="cat">
		    			<i class="fa fa-folder-open"></i>
						{{$vall->category}}

		    		</div>
		    		<div class="tag">
		    			<i class="fa fa-tags"></i>
              @foreach($posttag as $posttag)
		    			  <div class="chip"><a href="{{ route('getTag',['tag_id' => $posttag->tag_id])}}">{{ $posttag->tags->tag_name }}</a></div>
              @endforeach
		    		</div>
	    		</div>
					@endforeach
	    		<h5 style="margin-top: 30px;">ความคิดเห็น</h5>
		      	<hr>
		      	<!-- comment -->
		      	<div class="post-comments" id="add-comment-news" >
						@foreach($send as $sendd)
				      	<div class="post-comment">
				      		<div class="post-comment-picture">
				      			<img src="/avatar/{{ $sendd->userrrr->avatar }}">
				      		</div>
				      		<div class="post-comment-content">
				      			<div href="{{ route('profile.profile',['num'=>$sendd->member_comment_id])}}">{{ $sendd->userrrr->username }}</div>
                    <div>{{ $sendd->body }}</div>
  								@if(Auth::check())
  									<a href="#modal-reply" onclick="replyreply('{{ $sendd->id }}','{{ $sendd->statused->id}}')">ตอบกลับ</a>
  								@endif
								  &nbsp;
  								@if(Auth::check())
                    @if((Auth::user()->id)==($sendd->member_comment_id))
  										<a href="#modal-edit" onclick="ggg('{{ $sendd->body }}','{{ $sendd->id }}')">แก้ไข</a>
  									@endif

  								@endif
				      		</div>
				      	</div>
				  <!-- sub-comment -->

              @foreach($commentcomment as $commentcommen)
  								@if(($commentcommen->comment_commentincomment_id) == ($sendd->id))
  					      <div class="post-comment subcomment">
  					      	<div class="post-comment-picture">
  					      		<img src="/avatar/{{ $commentcommen->members->avatar }}">
  					      	</div>
  					      	<div class="post-comment-content">
					      		<div>{{ $commentcommen->members->username}}</div>
					      		<div>{{ $commentcommen->body }}</div>
					      		</div>
					      	</div>
								@endif
		          @endforeach
						@endforeach

				<!-- write comment -->
				</div>
					<form method="post" action="{{ route('comment.comment',['blog' => $blog]) }}" id="form_comment">
						<div class="input-field col s12">
							<textarea id="write-comment" class="materialize-textarea" name="textcomment" value="{{Request::old('textcomment')}}"></textarea>
							<div class="red-text" id='error_textcomment'>{{$errors->first('textcomment')}}</div>
								<label for="write-comment">เขียนความคิดเห็น...</label>
							<button type="submit" class="waves-effect waves-light btn">แสดงความคิดเห็น</button>
							<input type="hidden" name="_token" value="{{ Session::token() }}">
						</div>
					</form>
	    	</div>
	    </div>
    </div>
		<div id="show_modal_edit"></div>
		<div id="show-reply-reply"></div>
<!-- reply -->

<!-- edit -->



<script>
  $(document).ready(function(){
    $("#form_comment").submit(function(e){
        var fields = $('#form_comment').serialize();
            $.post("{{ route('comment.comment',['blog' => $blog]) }}", fields, function(data){
            if(data.vv !== undefined){
              $("#form_comment")[0].reset();
              $("#error_textcomment").html('');
              var str='';
              if(((data.xx).id)==((data.vv).member_comment_id)){
                str = '<a href="#" style="float:right; " data-toggle="modal" data-target="#edit-comment" onclick="ggg(\'' + (data.vv).body + '\',\'' + (data.vv).id + '\')">'+'แก้ไข'+'</a>'
              }
              $('#add-comment-news').append('<div class="post-comment">'+
									'<div class="post-comment-picture">'+
										'<img src="/avatar/'+(data.xx).avatar+'">'+
									'</div>'+
									'<div class="post-comment-content">'+
										'<div href="/profile/'+(data.xx).id+'">'+(data.xx).username+'</div>'+'<span style="font-size: 0.9rem;">'+'1 second ago'+'</span>'+
										'<div id="editt'+(data.vv).id+'">'+(data.vv).body+'</div>'+
										'<a href="#" onclick="replyreply(\'' + (data.vv).id + '\',\'' + (data.vv).blog_comment_id + '\')" data-toggle="modal" data-target="#reply-reply">'+'ตอบกลับ'+'</a>'+
										str+
									'</div>'+
								'</div>');
							}
              else{    //ไม่ผ่าน
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
    var id = data2;
    $('#show_modal_edit').html('<div id="modal-edit" class="modal">'+
			'<div class="modal-content">'+
			  	'<h4>'+'แก้ไขความคิดเห็น'+'</h4>'+
			  	'<div class="input-field col s12 mgt50">'+
					'<form id="edit-comment-ajax" method="POST">'+
		      		'<textarea id="text-comment" class="materialize-textarea">'+'</textarea>'+
		      		'<label for="write-comment" class="comment-left0">'+'เขียนความคิดเห็น...'+'</label>'+
		        	'<button type="submit" class="waves-effect waves-light btn modal-close">'+'ตกลง'+'</button>'+
							'<input type="hidden" name="_token" value="{{ Session::token() }}">'+
					'</form>'+
				'</div>'+
			'</div>'+
		'</div>');
    $('.modal').modal();
    $('#modal-edit').modal('open');
    $("#edit-comment-ajax").submit(function(){
      var dd = $('#text-comment').val();
      $.ajax({
        url:"{{ route('comment.edit') }}",
        type:"POST",
        data:{topic:dd,id:data2,_token:  "{{ Session::token() }}"},
        success:function(data){
          $('#editt'+id).html(data.topic)
        }
      });
      return false;
    });
  }
  function replyreply(data,data2){
    $('#show-reply-reply').html(
      '<div id="modal-reply" class="modal">'+
      	'<div class="modal-content">'+
      	  	'<h4>'+'ตอบกลับความคิดเห็น'+'</h4>'+
      	  	'<div class="input-field col s12 mgt50">'+
              '<form id="reply-reply-submit" method="post">'+
            		'<textarea id="reply-reply-text" class="materialize-textarea" required>'+'</textarea>'+
            		'<label for="write-comment" class="comment-left0">'+'เขียนความคิดเห็น...'+'</label>'+
              	'<button type="submit" class="waves-effect waves-light btn modal-close">'+'ตอบกลับความคิดเห็น'+'</button>'+
                '<input type="hidden" name="_token" value="{{ Session::token() }}">'+
              '</form>'+
      		'</div>'+
      	'</div>'+
      '</div>');
    $('.modal').modal();
    $('#modal-reply').modal('open');
    $('#reply-reply-submit').submit(function(){
    var id = data;
    var blog = data2;
    var body = $('#reply-reply-text').val()
    $.ajax({
      type:"POST",
      url:"{{ route('replyinreply') }}",
      data:{id:id,blog:blog,body:body,_token:  "{{ Session::token() }}"},
      success:function(data){
        $('#sf'+id).append('<div class="post-comment subcomment">'+
          '<div class="post-comment-picture">'+
            '<img src="/avatar/'+(data.ress).avatar+'">'+
          '</div>'+
          '<div class="post-comment-content">'+
          '<div>'+(data.ress).username+'</div>'+
          '<div>'+(data.res).body+'</div>'+
        '</div>'+
      '</div>')

      }
    });
    return false;
  })
}
</script>
@stop
