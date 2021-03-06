@extends('layouts.main')
@section('content')
	<div class="container main">
	    <div class="row">
			<div class="col s12 m9 l9">
				<div class="z-depth-3">
					<div class="news-header">
						<ul class="tabs">
					        <li class="tab col s3"><a class="active" href="#allnews" id="newwww">ข่าวสารทั้งหมด</a></li>
					        <li class="tab col s2"><a href="#news">ข่าว</a></li>
					        <li class="tab col s2"><a href="#discussion">สนทนา</a></li>
					        <li class="tab col s2"><a href="#review">รีวิว</a></li>
					        <li class="tab col s2"><a href="#jobs-and-intern">งาน</a></li>
				      	</ul>
					</div>
					<div id="allnews" class="news-content" class="col s12">
						@foreach($show as $showw)
							<div class="post moveIn">
								<div class="post-profile">
									<img src="/avatar/{{ $showw->member_userr->avatar }}">
								</div>
								<div class="topic">
									<a href="{{route('blog.blog',['blog' => $showw->id]) }}">{{ $showw->topic }}</a>
									<div class="detail">{!! str_limit($showw->body,10) !!}</div>
									<div class="post-user"><a href="{{ route('profile.profile',['num'=>$showw->member_id])}}" class="black-text">{{ $showw->member_userr->username }}</a><span style="font-size: 0.8rem;">&nbsp;{{ $showw->created_at->diffForHumans() }}</span></div>
								</div>
							</div>
						@endforeach
					</div>
    				<div id="news" class="news-content" class="col s12">
							@foreach($news as $news)
    					<div class="post moveIn">
		    				<div class="post-profile">
		    					<img src="/avatar/{{ $news->member_userr->avatar}}">
		    				</div>
		    				<div class="topic">
			    				<a href="{{route('blog.blog',['blog' => $news->id])}}">{{ $news->topic}}</a>
			    				<div class="detail">{!! str_limit($news->body,10) !!}</div>
			    				<div class="post-user"><a href="{{ route('profile.profile',['num'=>$news->member_id])}}" class="black-text">{{$news->member_userr->username}}</a><span style="font-size: 0.8rem;">&nbsp;{{ $news->created_at->diffForHumans()}}</span></div>
		    				</div>
		    			</div>
							@endforeach
    				</div>
    				<div id="discussion" class="news-content" class="col s12">
							@foreach($discussion as $discuss)
    					<div class="post moveIn">
		    				<div class="post-profile">
		    					<img src="/avatar/{{ $discuss->member_userr->avatar}}">
		    				</div>
		    				<div class="topic">
			    				<a href="{{route('blog.blog',['blog' => $discuss->id])}}">{{ $discuss->topic}}</a>
			    				<div class="detail">{!! str_limit($discuss->body,10) !!}</div>
			    				<div class="post-user"><a href="{{ route('profile.profile',['num'=>$discuss->member_id])}}" class="black-text">{{$discuss->member_userr->username}}</a><span style="font-size: 0.8rem;">&nbsp;{{ $discuss->created_at->diffForHumans() }}</span></div>
		    				</div>
		    			</div>
							@endforeach
    				</div>
    				<div id="review" class="news-content" class="col s12">
							@foreach($review as $review)
    					<div class="post moveIn">
		    				<div class="post-profile">
		    					<img src="/avatar/{{ $review->member_userr->avatar }}">
		    				</div>
		    				<div class="topic">
			    				<a href="{{route('blog.blog',['blog' => $review->id])}}">{{ $review->topic}}</a>
			    				<div class="detail">{!! str_limit($review->body,10) !!}</div>
			    				<div class="post-user"><a href="{{ route('profile.profile',['num'=>$review->member_id])}}" class="black-text">{{$review->member_userr->username}}</a><span style="font-size: 0.8rem;">&nbsp;{{ $review->created_at->diffForHumans() }}</span></div>
		    				</div>
		    			</div>
							@endforeach
    				</div>
    				<div id="jobs-and-intern" class="news-content" class="col s12">
							@foreach($job as $job)
    					<div class="post moveIn">
		    				<div class="post-profile">
		    					<img src="images/test.jpg">
		    				</div>
		    				<div class="topic">
			    				<a href="{{route('blog.blog',['blog' => $job->id])}}" >{{ $job->topic}}</a>
			    				<div class="detail">{!! str_limit($job->body,10) !!}</div>
			    				<div class="post-user"><a href="{{ route('profile.profile',['num'=>$job->member_id])}}" class="black-text">{{$job->member_userr->username}}</a><span style="font-size: 0.8rem;">&nbsp;{{ $job->created_at->diffForHumans() }}</span></div>
		    				</div>
		    			</div>
							@endforeach
    				</div>
				</div>
			</div>
			<div class="col s12 m3 l3 news-auther">
				<center><a class="waves-effect waves-light btn xxx" href="{{ route('create.topic')}}" id="post">สร้างข่าว</a></center>
			</div>
			@if(Auth::check())
		    @if((Auth::user()->type) == 'admin')
		      <div class="col-md-1">
		        เพิ่มTAGสำหรับADMIN
		        <form method="post" id="addcategory">
		          <input type="text" id="j" name="namecategory" class="form-control">
		          <button type="submit" >ตกลง</button>
		          <input type="hidden" name="_token" value="{{ Session::token() }}">
		        </form>
		      </div>
		      @endif
		    @endif
		</div>
    </div>
		<script>
y=10;
function rrr(){
	return y;
}
function plus(){
	y+=1;
}
		  $(document).ready(function(){

				var win = $(window);
				win.scroll(function() {
					if ($(document).height() - win.height() == win.scrollTop()) {
						plus()
						console.log(rrr())
						var g = rrr();
						$.ajax({
							url: "{{ route('scrollw') }}",
							type: "POST",
							data:{g:g,_token:  "{{ Session::token() }}"},
							success: function(data) {
								$('#allnews').append('<div class="post moveIn">'+
									'<div class="post-profile">'+
										'<img src="/avatar/'+data.member.avatar+'">'+
									'</div>'+
									'<div class="topic">'+
										'<a href="/feed/'+data.show.data[0].id+'">'+data.show.data[0].topic+'</a>'+
										'<div class="detail">'+data.show.data[0].body+'</div>'+
										'<div class="post-user">'+'<a href="{{ url("/feed/")}}/'+data.show.data[0].id+'" class="black-text">'+data.member.username+'</a><span style="font-size: 0.8rem;">&nbsp;'+data.time+'</span></div>'+
									'</div>'+
								'</div>')
							}
						});
					}
				});
		    $('#addcategory').submit(function(){
		      var j = $('#j').val();
		      $.ajax({
		        url:"{{ route('addcageory') }}",
		        type:"POST",
		        data:{j:j,_token:  "{{ Session::token() }}"},
		        success:function(data){
		          alert(data)
		          $('#j').val('');
		        }
		      });
		      return false;
		    })

		  })
		</script>
@stop
