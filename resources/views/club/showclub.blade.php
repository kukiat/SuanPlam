@extends('layouts.main')
@section('content')
	<div class="container main">
		<div class="club-header z-depth-3" style="background-image: url('/avatar/{{ $main->avatar }}');">
	        <h3 class="center-align white-text">{{ $main->club_name }}</h3>
		</div>
		<div class="row">
	    <div class="col s12 m12 l12">
	      	<ul class="tabs z-depth-3">
		        <li class="tab col s3 black-text text-black"><a href="#posts" class="active">ข่าวสาร</a></li>
		        <li class="tab col s3"><a href="#members">สมาชิก</a></li>
	      	</ul>
	    </div>

			<!-- Posts -->
		    <div id="posts" class="col s12 m12 l12">
		    	<div class="col s12 m12 l12">
		    		<div class="col s12 m9 l9 posts z-depth-3">
							@foreach($showfeed as $showfee)
			    			<div class="post moveIn">
			    				<div class="post-profile">
			    					<img src="/avatar/{{  $showfee->user->avatar }}">
			    				</div>
			    				<div class="topic">
				    				<a href="#modal-post" onclick="showfeedclub('{{ $showfee->id }}','{{ $showfee->user->username }}')">{{ $showfee->topic }}</a>
				    				<div class="detail">{!! str_limit($showfee->body,30) !!}</div>
				    				<div class="post-user"><a href="{{ route('profile.profile',['num'=>$showfee->user->id])}}" class="black-text">{{ $showfee->user->username }}</a><span style="font-size: 0.8rem;">&nbsp;{{ $showfee->created_at->diffForHumans()}}</span></div>
			    				</div>
			    			</div>
							@endforeach
						</div>
		    		<div class="col s12 m3 l3 detail">
		    			<!-- สร้างข่าวสาร -->
		    			<div class="col s12 m12 l12">
		    				<div class="z-depth-3 description">
									@if(Auth::check())
								    @if(Auth::user()->type == 'user')
								      @if($check)
						    			<center>
											<a href="{{ route('create.club',['id'=>$club]) }}"class="waves-effect waves-light btn" data-target="club-open" id="post">สร้างข่าวสาร</a></center>
											@else
						    			<!-- ขอเข้าชมรม -->
						    			<center>
											<a class="waves-effect waves-light btn" onclick="gotorequest('{{ $club }}',{{ Auth::user()->id}})">ขอเข้าชมรม</a></center>
											@endif
								    @endif
								  @endif
		    					<h5>คำอธิบายชมรม</h5>
		    					<p>{{ $main->detail }}</p>
		    				</div>
		    			</div>
		    		</div>
		    	</div>
		    </div>
		    <!-- Members -->
		    <div id="members" class="col s12">
			    <div class="col s12 m12 l12 z-depth-3 members">
						@foreach($showmember as $showmembe)
			    		<div class="col s12 m6 l4 member">
			    			<div class="member-picture">
			    				<img src="/avatar/{{ $showmembe->user->avatar }}">
			    			</div>
			    			<div class="member-profile">
			    				<a href="{{ route('profile.profile',['num'=>$showmembe->user->id])}}" class="black-text">{{ $showmembe->user->username }}</a>
									เข้าร่วมเมื่อ{{ $showmembe->created_at->diffForHumans() }}
			    			</div>
			    		</div>
						@endforeach
	    		</div>
		    </div>
	  	</div>

	</div>

<div id="tttt"></div>
  <!-- Modal Structure -->
  <!-- picture edit -->
  <div id="modal-editpicture" class="modal">
  	<div class="modal-content">
  	  	<h4>แก้ไขรูปภาพชมรม</h4>
  	  	<div class="input-field file-field col s12 ">
  	  		<form enctype="multipart/form-data" method="POST" action="{{ route('editclubpic') }}">
  	      		<div class="btn">
  		        	<span>File</span>
                <input type="hidden" name="hiddenclub" value="{{ $main->id }}">
  		        	<input type="file" name="avatarclub">
  		    	</div>
  		    	<div class="file-path-wrapper">
  		        	<input class="file-path validate" type="text">
  		    	</div>
  		    	<button type="submit" class="waves-effect waves-light btn btn-flat right">เปลี่ยนรูปภาพ</button>
            <input type="hidden" name="_token" value="{{ Session::token() }}">
  	    	</form>
  		</div>
  	</div>
  </div>


	<script>
	  $(document).ready(function(){
	    $(document).on('submit','#submitcommentclub',function(){
	      var text = $('.textclubcommentt').val()
	      var id = $('#hiddenidclub').val()
	      $.ajax({
	        url:"{{ route('postcommentclub')}}",
	        type:"POST",
	        data:{text,text,id:id,_token:"{{ Session::token() }}"},
	        success:function(data){
            $('#add-commentt').append(
              '<div class="post-comment">'+
                '<div class="post-comment-picture">'+
                  '<img src="/avatar/'+(data.name).avatar+'">'+
                '</div>'+
                '<div class="post-comment-content">'+
                  '<div>'+(data.name).username+'</div>'+
                  '<div>'+(data.comment).body+'</div>'+
                '</div>'+
              '</div>'+'<hr>'
            )
            $('.textclubcommentt').val('')
	        }
	      })
	      return false;
	    })
	  })
	  function gotorequest(clubid,memberid){
	    var id = clubid;
	    var member = memberid;
	    $.ajax({
	      url:"{{ route('postrequestclubforother') }}",
	      type:"POST",
	      data:{id:id,member:member,_token:"{{ Session::token() }}"},
	      success:function(data){
	        alert(data)
	      }
	    })
	    return false;
	  }
	  function showfeedclub(id,name){
	    $.ajax({
	      url:"{{ route('postclubdetail') }}",
	      type:"POST",
	      data:{id:id,_token:"{{ Session::token() }}"},
	      success:function(data){
          var comments='';
					for(i in data.name){
            var user = data.name[i].username
            var text =data.commentfeedclub[i].body
            var pic = data.name[i].avatar
            comments += '<div class="post-comment">'+
              '<div class="post-comment-picture">'+
                '<img src="/avatar/'+pic+'">'+
              '</div>'+
              '<div class="post-comment-content">'+
                '<div>'+user+'</div>'+
                '<div>'+text+'</div>'+
              '</div>'+
            '</div>'+'<hr>';
          }
					$('#tttt').html('<div id="modal-post" class="modal" style="padding-bottom: 20px;">'+
              '<div class="modal-content">'+
                '<h4>'+data.feedclub.topic+'</h4>'+
                '<p>'+data.feedclub.body+'</p>'+
                '<h5 style="margin-top: 30px;">'+'ความคิดเห็น'+'</h5>'+
                '<hr>'+
                '<div class="post-comments" id="add-commentt">'+
                  comments+
								'</div>'+
                '<form id="submitcommentclub" method="post">'+
                  '<div class="input-field col s12">'+
                        '<input type="hidden" id="hiddenidclub" value="'+id+'">'+
                        '<textarea id="write-comment" class="materialize-textarea textclubcommentt">'+'</textarea>'+
                        '<label for="write-comment">'+'เขียนความคิดเห็น...'+'</label>'+
                        '<button type="submit" class="waves-effect waves-light btn">'+'แสดงความคิดเห็น'+'</button>'+
                        '<input type="hidden" name="_token" value="{{ Session::token() }}">'+
                      '</div>'+
                    '</form>'+
              '</div>'+
            '</div>'
          )
					$('.modal').modal();
        	$('#modal-post').modal('open');
	      }
	    })
	  }
	</script>
@stop
