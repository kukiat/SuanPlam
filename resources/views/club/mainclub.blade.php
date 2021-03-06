@extends('layouts.main')
@section('content')
<div class="container main">
		<div class="row">
			<div class="col s12 m12 l12">
				<h4>ข่าวสารล่าสุดจากชมรมต่างๆ</h4>

					<ul class="collection with-header z-depth-2">
						@foreach($feedrecent as $feedrecen)
				  		<li class="collection-item"><a href="{{ route('getpage.getpage',['club' => $feedrecen->clubmains->id] ) }}">{{$feedrecen->clubmains->club_name}}</a> :
							<a href="#feed" onclick="showfeedclubb('{{ $feedrecen->id }}','{{ $feedrecen->clubmains->club_name }}')">{{$feedrecen->topic}}</a><span class="right">{{$feedrecen->created_at->diffForHumans()}}</span></li>
						@endforeach
					</ul>

			</div>
			<div class="col s12 m12 l12 create-club">
				<h2>ชมรมในเว็บไซต์สวนปาล์ม</h2>
				@if(Auth::check())
					@if(Auth::user()->type == 'user')
						<a class="waves-effect waves-light btn hoverable" data-target="openclub">ขอเปิดชมรม</a>
					@endif
				@endif
			</div>
			<div class="col s12 m12 l12">
				<div class="col s6 m3 l3">
					<p>
				    	<input type="checkbox" class="filled-in" id="academic" checked="checked" />
				    	<label for="academic">
					    	<img src="images/academic.png" width="40" height="40">
					    	วิชาการ
				    	</label>
				    </p>
				</div>
				<div class="col s6 m3 l3">
					<p>
				    	<input type="checkbox" class="filled-in" id="sport" checked="checked" />
				    	<label for="sport">
					    	<img src="images/sport.png" width="40" height="40">
					    	กีฬาและการออกกำลัง
				    	</label>
				    </p>
				</div>
				<div class="col s6 m3 l3">
					<p>
				    	<input type="checkbox" class="filled-in" id="outreach" checked="checked" />
				    	<label for="outreach"><img src="images/Outreach.png" width="40" height="40">บำเพ็ญประโยชน์</label>
				    </p>
				</div>
				<div class="col s6 m3 l3">
					<p>
				    	<input type="checkbox" class="filled-in" id="culture" checked="checked" />
				    	<label for="culture"><img src="images/culture.png" width="40" height="40">ศิลปะและวัฒนธรรม</label>
				    </p>
				</div>
			</div>
		</div>

		<div class="row cards large">
			@foreach($clubmain as $clubmainn)
			<div class="col s6 m4 l4">
				<div class="card hoverable">
				    <div class="card-image waves-effect waves-block waves-light">
				      	<div class="club-class">
					      	<img src="images/academic.png">
				      		<img src="images/sport.png">
					      	<img src="images/outreach.png">
					      	<img src="images/culture.png">
				      	</div>
				     	<img class="activator" src="/avatar/{{ $clubmainn->avatar }}">
				    </div>
				    <div class="card-content">
				      <span class="card-title activator grey-text text-darken-4">{{ $clubmainn->club_name }}</span>
				      <p>{{ $clubmainn->detail }}</p>

				    </div>
				    <div class="card-reveal">
				      <span class="card-title grey-text text-darken-4">{{ $clubmainn->club_name }}</span>
				      <p class="card-title">{{ $clubmainn->detail }}</p>
				    </div>
						<div class="card-action center-align waves-effect waves-light" onclick="window.location='{{ route('getpage.getpage',['club'=> $clubmainn->id ]) }}'	">
			        <a href="{{ route('getpage.getpage',['club'=> $clubmainn->id ]) }}" class="text-white white-text">เข้าดูชมรม</a>
			      </div>
				</div>
			</div>
			@endforeach
		</div>
	</div>
	<!-- ขอเปิดชมรม -->
	@if(Auth::check())
    @if(Auth::user()->type == 'user')
			<div id="openclub" class="modal modal-fixed-footer">
				<form method="POST" action="{{ route('postrequest.postrequest') }}">
				    <div class="modal-content">
				      	<h4 style="margin-bottom: 30px">ขอเปิดชมรม</h4>
				      	<div class="input-field">
					        <input id="clubName" type="text" class="validate" name="clubnameopen">
				            <label for="clubName">ชื่อชมรม</label>
				        </div>
				        <div class="input-field">
				          	<textarea id="clubDescription" class="materialize-textarea" name="clubdetailopen"></textarea>
				          	<label for="clubDescription">คำอธิบายชมรม</label>
				        </div>
				        <h6>ชมรมนี้เกียวข้องกับ</h6>
				        <div class="row club-open-class">
				        	<div class="col s6 m3 l3">
					        	<input type="checkbox" value="academic" class="filled-in" name="tag_club[]" id="club-open-academic"/>
						    		<label for="club-open-academic"><img src="images/academic.png" width="40" height="40">วิชาการ</label>
				        	</div>
				        	<div class="col s6 m3 l3">
							    	<input type="checkbox" value="outreach" class="filled-in" name="tag_club[]" id="club-open-sport"/>
							    	<label for="club-open-sport">
							    	<img src="images/sport.png" width="40" height="40">กีฬาและการออกกำลัง</label>
									</div>
									<div class="col s6 m3 l3">
							    	<input type="checkbox" value="culture" class="filled-in" name="tag_club[]" id="club-ope-outreach"/>
							    	<label for="club-ope-outreach"><img src="images/Outreach.png" width="40" height="40">บำเพ็ญประโยชน์</label>
									</div>
									<div class="col s6 m3 l3">
								    <input type="checkbox" value="sport" class="filled-in" name="tag_club[]" id="club-open-culture"/>
								    <label for="club-open-culture"><img src="images/culture.png" width="40" height="40">ศิลปะและวัฒนธรรม</label>
									</div>
				        </div>
				    </div>

				    <div class="modal-footer">
				      	<input type="submit" class="modal-action modal-close btn-flat" class="req-open-club"></input>
								<input type="hidden" name="_token" value="{{ Session::token() }}">
				      	<a href="#!" class="modal-action modal-close btn-flat">ยกเลิก</a>
				    </div>
			    </form>
				</div>
		@endif
	@endif
  <div id="ttt"></div>
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
	    $(document).on('submit','#submitcommentclub',function(){
	      var text = $('.textclubcomment').val()
	      var id = $('#hiddenidclub').val()
	      $.ajax({
	        url:"{{ route('postcommentclub')}}",
	        type:"POST",
	        data:{text,text,id:id,_token:"{{ Session::token() }}"},
	        success:function(data){
            $('#add-comment').append(
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
	          $('.textclubcomment').val('')
	        }
	      })
	      return false;
	    })
	  })

	  function showfeedclubb(id,name){
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
          $('#ttt').html('<div id="news" class="modal" style="padding-bottom: 20px;">'+
              '<div class="modal-content">'+
                '<h4>'+data.feedclub.topic+'</h4>'+
                '<p>'+data.feedclub.body+'</p>'+
                '<h5 style="margin-top: 30px;">'+'ความคิดเห็น'+'</h5>'+
                '<hr>'+
                '<div class="post-comments" id="add-comment">'+
                comments+

                '</div>'+
                '<form id="submitcommentclub" method="post">'+
                  '<div class="input-field col s12">'+
                        '<input type="hidden" id="hiddenidclub" value="'+id+'">'+
                        '<textarea id="write-comment" class="materialize-textarea textclubcomment">'+'</textarea>'+
                        '<label for="write-comment">'+'เขียนความคิดเห็น...'+'</label>'+
                        '<button type="submit" class="waves-effect waves-light btn">'+'แสดงความคิดเห็น'+'</button>'+
                        '<input type="hidden" name="_token" value="{{ Session::token() }}">'+
                      '</div>'+
                    '</form>'+
              '</div>'+
            '</div>'
          )
        	$('.modal').modal();
        	$('#news').modal('open');
        }
	    })
	  }
	</script>
@stop
