@extends('layouts.main')
@section('content')
<div class="row">
  <div class="col-md-1"></div>
  <div class="col-md-10">
    <ul class="nav nav-tabs">
      <li class="active"><a data-toggle="tab" href="#all_page">ข่าวทั้งหมด</a></li>
      <li><a data-toggle="tab" href="#disscuss">Discussion</a></li>
      <li><a data-toggle="tab" href="#review">Review</a></li>
      <li><a data-toggle="tab" href="#job">Job</a></li>
      <li><a data-toggle="tab" href="#news">News</a></li>
      <li><a data-toggle="tab" href="#interview">Interview</a></li>
    </ul>
    <div class="tab-content">
      <!--  ALL -->
      <div id="all_page" class="tab-pane fade in active">
        <div class="row" style="height:600px;overflow-y:auto; border: thin solid black; margin:5px">
          @foreach($show as $showw)
          <div class="media" style="border-radius:10px;border: 1px;margin:10px 5px 0px 20px;">
            <a class="media-left" href="{{ route('profile.profile',['num'=>$showw->member_id]) }}">
              <img class="media-object img-circle" src="/avatar/{{ $showw->member_userr->avatar }}" alt="Generic placeholder image" style="weight:50px; height:70px;">
            </a>
            <div class="media-body">
              <h4 class="media-heading">
                <a href="{{route('blog.blog',['blog' => $showw->id])}}" class="list-group-item" target="_blank">
                  <h4 class="list-group-item-heading">{{ $showw->topic }}</h4>
                </a></h4>
                <span style="padding-left:15px;">News by </span>
                <a style="color: #333333;font-weight:bold;"href="{{ route('profile.profile',['num'=>$showw->member_id])}}">{{ $showw->member_userr->username }}</a>
            </div>
          </div>
          @endforeach
        </div>
      </div>
      <!-- END ALL -->
      <!-- DISSCUSSION -->
      <div id="disscuss" class="tab-pane fade">
        <div class="row" style="height:600px;overflow-y:auto; border: thin solid black; margin:5px">
          @foreach($discussion as $discuss)
          <div class="media" style="border-radius:10px;border: 1px;margin:10px 5px 0px 20px;">
            <a class="media-left" href="{{ route('profile.profile',['num'=>$discuss->member_id]) }}">
              <img class="media-object img-circle" src="/avatar/{{ $discuss->member_userr->avatar}}" alt="Generic placeholder image" style="weight:50px; height:70px;">
            </a>
            <div class="media-body">
              <h4 class="media-heading">
                <a href="{{route('blog.blog',['blog' => $discuss->id]) }}" class="list-group-item" target="_blank">
                  <h4 class="list-group-item-heading">{{ $discuss->topic}}</h4>
                </a></h4>
                <span style="padding-left:15px;">News by </span>
                <a style="color: #333333;font-weight:bold;"href="{{ route('profile.profile',['num'=>$discuss->member_id])}}">{{$discuss->member_userr->username}}</a>
            </div>
          </div>
          @endforeach
        </div>
      </div>
      <!-- END DISSCUSSION -->
      <!-- review -->
      <div id="review" class="tab-pane fade">
        <div class="row" style="height:600px;overflow-y:auto; border: thin solid black; margin:5px">
          @foreach($review as $review)
          <div class="media" style="border-radius:10px;border: 1px;margin:10px 5px 0px 20px;">
            <a class="media-left" href="{{ route('profile.profile',['num'=>$review->member_id])}}">
              <img class="media-object img-circle" src="/avatar/{{ $review->member_userr->avatar }}" alt="Generic placeholder image" style="weight:50px; height:70px;">
            </a>
            <div class="media-body">
              <h4 class="media-heading">
                <a href="{{route('blog.blog',['blog' => $review->id])}}" class="list-group-item" target="_blank">
                  <h4 class="list-group-item-heading">{{ $review->topic}}</h4>
                </a></h4>
                <span style="padding-left:15px;">News by </span>
                <a style="color: #333333;font-weight:bold;"href="{{ route('profile.profile',['num'=>$review->member_id])}}">{{$review->member_userr->username}}</a>
            </div>
          </div>
          @endforeach
        </div>
      </div>
      <!-- END review -->
      <!-- news -->
      <div id="news" class="tab-pane fade">
        <div class="row" style="height:600px;overflow-y:auto; border: thin solid black; margin:5px">
          @foreach($news as $news)
          <div class="media" style="border-radius:10px;border: 1px;margin:10px 5px 0px 20px;">
            <a class="media-left" href="{{ route('profile.profile',['num'=>$news->member_id])}}">
              <img class="media-object img-circle" src="/avatar/{{ $news->member_userr->avatar}}" alt="Generic placeholder image" style="weight:50px; height:70px;">
            </a>
            <div class="media-body">
              <h4 class="media-heading">
                <a href="{{route('blog.blog',['blog' => $news->id])}}" class="list-group-item" target="_blank">
                  <h4 class="list-group-item-heading">{{ $news->topic}}</h4>
                </a></h4>
                <span style="padding-left:15px;">News by </span>
                <a style="color: #333333;font-weight:bold;"href="{{ route('profile.profile',['num'=>$news->member_id])}}">{{$news->member_userr->username}}</a>
            </div>
          </div>
          @endforeach
        </div>
      </div>
      <!-- END news -->
      <!-- job -->
      <div id="job" class="tab-pane fade">
        <div class="row" style="height:600px;overflow-y:auto; border: thin solid black; margin:5px">
          @foreach($job as $job)
          <div class="media" style="border-radius:10px;border: 1px;margin:10px 5px 0px 20px;">
            <a class="media-left" href="{{ route('profile.profile',['num'=>$job->member_id])}}">
              <img class="media-object img-circle" src="/avatar/{{ $job->member_userr->avatar}}" alt="Generic placeholder image" style="weight:50px; height:70px;">
            </a>
            <div class="media-body">
              <h4 class="media-heading">
                <a href="{{route('blog.blog',['blog' => $job->id])}}" class="list-group-item" target="_blank">
                  <h4 class="list-group-item-heading">{{ $job->topic}}</h4>
                </a></h4>
                <span style="padding-left:15px;">News by </span>
                <a style="color: #333333;font-weight:bold;"href="{{ route('profile.profile',['num'=>$job->member_id])}}">{{$job->member_userr->username}}</a>
            </div>
          </div>
          @endforeach
        </div>
      </div>
      <!-- END job -->
      <!-- interview -->
      <div id="interview" class="tab-pane fade">
        <div class="row" style="height:600px;overflow-y:auto; border: thin solid black; margin:5px">
          @foreach($interview as $interview)
          <div class="media" style="border-radius:10px;border: 1px;margin:10px 5px 0px 20px;">
            <a class="media-left" href="{{ route('profile.profile',['num'=>$interview->member_id])}}">
              <img class="media-object img-circle" src="/avatar/{{ $interview->member_userr->avatar}}" alt="Generic placeholder image" style="weight:50px; height:70px;">
            </a>
            <div class="media-body">
              <h4 class="media-heading">
                <a href="{{route('blog.blog',['blog' => $interview->id])}}" class="list-group-item" target="_blank">
                  <h4 class="list-group-item-heading">{{ $interview->topic}}</h4>
                </a></h4>
                <span style="padding-left:15px;">News by </span>
                <a style="color: #333333;font-weight:bold;"href="{{ route('profile.profile',['num'=>$interview->member_id])}}">{{$interview->member_userr->username}}</a>
            </div>
          </div>
          @endforeach
        </div>
      </div>
      <!-- END interview -->
    </div>

  </div>
  <div class="col-md-1">
    <a class="btn btn-primary" href="{{ route('create.topic')}}">Create</a>
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
<script>
  $(document).ready(function(){
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
