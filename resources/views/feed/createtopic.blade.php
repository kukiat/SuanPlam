@extends('layouts.main')
@section('content')
<div class="container">
  <form role="form" method="post" action=" {{ route('status.post') }} ">
    <div class="form-group{{ $errors->has('topic') ? ' has-error' : '' }}">
      <input placeholder="" class="form-control" name="topic" required></input>
        @if ($errors->has('topic'))
          <span class="help-block">{{ $errors->first('topic') }} </span>
        @endif
    </div>

    <div class="form-group{{ $errors->has('txx') ? ' has-error' : '' }}">
      <textarea class="form-control" name="txx" ></textarea>
        @if ($errors->has('txx'))
          <span class="help-block">{{ $errors->first('txx') }}</span>
        @endif
    </div><br>
    <select class="input-field col s12" name="categoryy">
      <option value="news">News</option>
      <option value="discussion">Discussion</option>
      <option value="review">Review</option>
      <option value="job">Job</option>
    </select>
    <select class="form-control" name="tag_select[]" multiple="multiple">
      @foreach($tag as $tag)
        <option value="{{ $tag->id}}">{{ $tag->tag_name}}</option>
      @endforeach
    </select>
    <div class="form-group">
      <button type="submit" class="btn btn-success">ตกลง</button>
    </div>
    <input type="hidden" name="_token" value="{{ Session::token() }}">
  </form>
</div>

<script>
  $(document).ready(function() {
    $('select').material_select();
  });
  tinymce.init({
    selector:'textarea',
    height: 350,
  });
</script>
@stop
