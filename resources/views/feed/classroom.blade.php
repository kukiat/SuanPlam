@extends('layouts.main')
@section('content')
<div class="container main">


  <div class="row">
      <div class="col s12 m6 l5" class="left">
        <div class="course z-depth-3">

          <div class="head">
            <select class="browser-default term select" id="select">
                <option value="0">All</option>
                <option value="01">คณะวิศวกรรมศาสตร์</option>
                <option value="02">คณะครุศาสตร์อุตสาหกรรม</option>
                <option value="03">วิทยาลัยเทคโนโลยีอุตสาหกรรม</option>
                <option value="04">คณะวิทยาศาสตร์ประยุกต์</option>
                <option value="05">คณะอุตสาหกรรมเกษตร</option>
                <option value="06">คณะเทคโนโลยีและการจัดการอุตสาหกรรม</option>
                <option value="07">คณะเทคโนโลยีสารสนเทศ</option>
                <option value="08">คณะศิลปศาสตร์ประยุกต์</option>
            </select>

            <select class="browser-default term oo select">
                <option value="0">All</option>
            </select>
            <input placeholder="ชื่อวิชาหรือรหัสวิชา" id="search" type="text" class="validate classroom-search search">
            <i class="fa fa-close fa-lg search-reset" id="clear" style="margin-left: -20px;margin-top: 10px;color: #FF5A1D "></i>
          </div>

          <div class="course-body shower">
              @foreach($yoyo as $yoyo)
             <div class="course-card bb" onclick="detail('{{ $yoyo->code }}')">
              <span class="course-id">
                {{ $yoyo->code }}
              </span>
              <span class="course-name">
                {{ $yoyo->name }}
              </span>
             </div>
            @endforeach
            </div>
          </div>

        </div>

      <div class="col m6 l7 hide-on-small-only" class="right">
        <div class="details z-depth-3">
          <div class="head valign-wrapper">
               <h5 class="center-align valign ">รายละเอียด</h5>
          </div>
          <div class="detail-body" id="showw">
            <div class="col s12 m12 l12 z-depth-1"  style="background-color: white;margin-top: 10px;margin-bottom: 10px;border-radius: 5px">

                <h5 class="center-align" id="show2"></h5>
                 <h5 class="center-align " id="show3"></h5>
              <ul class="collection showw1">
                  <!-- <li class="collection-item avatar">
                  <i class="red circle">S.1</i>
                  <span class="title"> <b>Time : W 13:00-16:00</b></span>
                  <p>
                    <b>Profressor : 04-ABC</b>
                  <br>
                    <b>Room : 78-318</b>
                  </p>
                  </li> -->

              </ul>

            </div>
            @if(Auth::check())
            <div class="post-comments show_comment">
            <!-- comment -->




                  <!-- <div class="post-comment">
                    <div class="post-comment-picture">
                      <img src="images/test.jpg">
                    </div>
                    <div class="post-comment-content">
                      <div>ชื่อ </div>
                      <div>เนื้อหาที่คอมเมนต์</div>
                    </div>
                  </div>
                  <div id='comment_class'></div>
 -->            </div>


                  <form id="submit_comment_class" method="POST">
                <div class="input-field col s12">
                        <textarea  class="materialize-textarea" name="comment_text_class" id="comment_text_class"></textarea>


                      <input type="submit" class="waves-effect waves-light btn" value="แสดงความคิดเห็น" >
                      <input type="hidden" name="_token" value="{{ Session::token() }}">
                    </div>
                  </form>
            @endif
        </div>
      </div>

    </div>
  </div>
</div>

<script>
  $(document).ready(function(){


    $(document).on('submit','#submit_comment_class',function(){
      var id = $('#show3').text();
      var body = $('#comment_text_class').val()

      $.ajax({
        type:"POST",
        url:"{{ route('comment.class') }}",
        data:{id:id,body:body,_token: "{{ Session::token() }}"},
        success:function(data){
          console.log(data.comment)
           $('.show_comment').append('<div class="post-comment"> <div class="post-comment-content"><div> Name : '+(data.member_user).username+'</div>'+'<div> Note :'+(data.comment).body+'</div></div></div>')
        }
      })
      return false;
    });
  });
</script>
<!-- END MODAL -->
@stop
