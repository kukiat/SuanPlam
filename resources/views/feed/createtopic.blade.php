@extends('layouts.main')
@section('content')
<form role="form" method="post" action=" {{ route('status.post') }} ">
  <div class="form-group{{ $errors->has('topic') ? ' has-error' : '' }}">
    <input placeholder="" class="form-control" name="topic"></input>
      @if ($errors->has('topic'))
        <span class="help-block">{{ $errors->first('topic') }} </span>
      @endif
  </div>

  <div class="form-group{{ $errors->has('txx') ? ' has-error' : '' }}">
    <textarea class="form-control" name="txx" id="summer"></textarea>
      @if ($errors->has('txx'))
        <span class="help-block">{{ $errors->first('txx') }}</span>
      @endif
  </div>
  <div ng-app="myApp">
    <div ng-controller="checkboxCtrl">
      <div class="col-md-3">
        <div ng-repeat="user in member" class="checkbox">
          <input type="checkbox" nd-model="selected" ng-checked="exist(user)" ng-click="toggleSelection(user)">@{{user.name}}
        </div>
        <div class="form-group">
          <button type="submit" class="btn btn-success">ตกลง</button>
        </div>
      </div>
      <div class="col-md-9">
        <p ng-repeat="selectedName in selected">
          <span class="label label-primary">@{{selectedName.name}}</span>
        </p>
      </div>

    </div>

  </div>


  <input type="hidden" name="_token" value="{{ Session::token() }}">
</form>

<script>
  $(document).ready(function() {
        $('#summer').summernote({
          height: 300,
          minHeight: null,
          maxHeight: null,
          focus: true
        });
    });
  var app = angular.module("myApp",[])
  app.controller("checkboxCtrl",function($scope){
    $scope.member=[
      {name:'ข่าวทั่วไป'},
      {name:'ข่าวการเมือง'},
      {name:'ถาม-ตอบ'},
      {name:'ข่าวรับน้อง'},
      {name:'รีวิว'},
      {name:'ท่องเที่ยว'},
      {name:'สมัครงาน'},
      {name:'ทุนวิจัย'},
      {name:'ศิษย์เก่า'},
    ];
    $scope.selected = [];
    $scope.exist =  function(item){
      return $scope.selected.indexOf(item) > -1;
    }
    $scope.toggleSelection = function(item){
      var idx = $scope.selected.indexOf(item);
      if(idx > -1){
        $scope.selected.splice(idx,1);
      }else{
        $scope.selected.push(item);
      }
    }
  });
</script>
@stop
