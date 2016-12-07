@extends('layouts.main')
@section('content')
<!DOCTYPE html>
<div class="row">
  <div class="col-md-1"></div>
  <div class="col-md-10">
    <h1>ข่าวเกี่ยวกับ {{ $posttags->tags->tag_name}}</h1>
    <div class="tab-pane">
      <div class="row" style="height:600px;overflow-y:auto; border: thin solid black; margin:5px">
        @foreach($posttag as $posttag)
        <div class="media" style="border-radius:10px;border: 1px;margin:10px 5px 0px 20px;">
          <a class="media-left" href="{{ route('profile.profile',['num'=> $posttag->posts->member_userr->id]) }}">
            <img class="media-object img-circle" src="/avatar/{{ $posttag->posts->member_userr->avatar }}" alt="Generic placeholder image" style="weight:50px; height:70px;">
          </a>
          <div class="media-body">
            <h4 class="media-heading">
              <a href="{{route('blog.blog',['blog' => $posttag->post_id])}}" class="list-group-item" target="_blank">
                <h4 class="list-group-item-heading">{{ $posttag->posts->topic}}</h4>
              </a></h4>
              <span style="padding-left:15px;">News by </span>
              <a style="color: #333333;font-weight:bold;"href="{{ route('profile.profile',['num'=> $posttag->posts->member_userr->id ])}}">{{ $posttag->posts->member_userr->username }}</a>
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </div>
  <div class="col-md-1"></div>
</div>
@stop
