@extends('layouts.main')
@section('content')
<div class="row">
  <div class="col-md-1"></div>
  <div class="col-md-10">
    <ul class="nav nav-tabs">
      <li class="active"><a data-toggle="tab" href="#other">ทั้งหมด</a></li>
      <li><a data-toggle="tab" href="#menu1">ข่าวประชาสัมพันธ์</a></li>
      <li><a data-toggle="tab" href="#menu2">ข่าวรับน้อง</a></li>
      <li><a data-toggle="tab" href="#menu3">ถามตอบทั่วไป</a></li>
    </ul>
    <div class="tab-content">
      <div id="other" class="tab-pane fade in active">
        <div class="row" style="height:600px;overflow-y:auto; border: thin solid black; margin:5px">
          @foreach($show as $showw)
          <div class="media" style="border-radius:10px;border: 1px;margin:10px 5px 0px 20px;">
            <a class="media-left" href="{{ route('profile.profile',['num'=>$showw->member_id])}}">
              <img class="media-object img-circle" src="/avatar/{{ $showw->member_userr->avatar}}" alt="Generic placeholder image" style="weight:50px; height:70px;">
            </a>
            <div class="media-body">
              <h4 class="media-heading">
                <a href="{{route('blog.blog',['blog' => $showw->id])}}" class="list-group-item" target="_blank">
                  <h4 class="list-group-item-heading">{{ $showw->topic}}</h4>
                </a></h4>
                <span style="padding-left:15px;">News by </span>
                <a style="color: #333333;font-weight:bold;"href="{{ route('profile.profile',['num'=>$showw->member_id])}}">{{$showw->member_userr->username}}</a>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-1">
    <a class="btn btn-primary" href="{{ route('create.topic')}}">Create</a>
  </div>
</div>
@stop
