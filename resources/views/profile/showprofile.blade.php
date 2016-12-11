@extends('layouts.main')
@section('content')
@foreach($numprofile as $numprofile)
  <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad" >
    <div class="panel panel-info">
      <div class="panel-heading">
        <h2 class="panel-title">Profile</h2>
      </div>
      <div class="panel-body">
        <div class="row">
          <div class="col-md-3 col-lg-3 " align="center">
            <a href="" data-toggle="modal" data-target="#editpic"><img class="img-circle img-responsive" src="/avatar/{{ $numprofile->avatar }}" style="weight:100px; height:100px; float:left;"/></a>

          </div>
            <div class="col-md-9 col-lg-9 ">

              <table class="table table-user-information">
                <tbody>
                  <tr>
                    <td>Username:</td>
                    <td>{{$numprofile->username}}</td>
                  </tr>
                  <tr>
                    <td>Student ID:</td>
                    <td id="a">{{$numprofile->studentid_name}}</td>
                  </tr>
                  <tr>
                    <td>Department:</td>
                    <td id="b">{{$numprofile->faculty_name}}</td>

                  </tr>
                  <tr>
                    <td >Faculty:</td>
                    <td id="c">{{$numprofile->department_name}}</td>

                  </tr>
                </tbody>
              </table>
              @if(Auth::check())
                @if((Auth::user()->id)==($numprofile->id))
                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#edit">แก้ไข</button>
                @endif
              @endif
            </div>
          </div>
        </div>
      </div>
    </div>
    @endforeach
    <div class="col-md-3">
      @if(Auth::check())
        @if(Auth::user()->type == 'user') <!--ของแอดมินเท่านั้น -->
          @if(Auth::user()->id == $num)
            <input type="button" value="ขอเปิดชมรม" class="btn btn-success" data-toggle="modal" data-target="#openclub">
          @endif
        @endif
        @if(Auth::user()->type == 'admin') <!--ของแอดมินเท่านั้น -->
          @if(Auth::user()->id == $num)
            <h2>คนขอสร้างชมรม</h2>
            @foreach($clubrequest as $clubreques)
            <div id="{{ $clubreques->id }}">
              คนที่ขอเปิด : {{ $clubreques->members->username }}
              ชื่อชมรม : {{ $clubreques->club_name }}
              รายละเอียด : {{ $clubreques->detail }}

              <button type="button" class="btn btn-success" onclick="requestsubmit('{{ $clubreques->id }}','{{ $clubreques->member_request_id }}')">ตกลง</button>
              <button type="button" class="btn btn-danger" onclick="requestreject('{{ $clubreques->id }}')">ไม่อนุมัต</button>
              <br><hr>
            </div>
            @endforeach
            <h2>คนขอเข้าชมรมทั้งหมด</h2>
            @foreach($norequest as $noreques)
              <div id="club{{ $noreques->id }}">
                <b>ชื่อ</b> {{ $noreques->members->username }}
                <b>ชมรมที่ขอเข้า</b> {{ $noreques->club->club_name }}
                <b>เวลา</b> {{ $noreques->created_at }}
                <button type="button" class="btn btn-success" onclick="requestsubmitclub('{{ $noreques->id }}')">ตกลง</button>
                <button type="button" class="btn btn-danger" onclick="requestrejectclub('{{ $noreques->id }}')">ไม่อนุมัต</button>
                <hr>
              </div>
            @endforeach
          @endif
        @else <!--หลังจากนี้คือคนทั่วไป -->
          @if(Auth::user()->id == $num)
            <h2>เพื่อนที่ขอเข้าชมรม</h2>
            @foreach($yesrequestuser as $yesrequestuse)
              @foreach($norequestuser as $norequestuse)
                @if(($yesrequestuse->club_yesrequestclub_id) == ($norequestuse->club_norequestclub_id))
                  <div id="friend{{ $norequestuse->id }}">
                    <h4>ชื่อ{{ $norequestuse->members->username }}</h4>
                    <h4>ชื่อ{{ $norequestuse->members->username }}</h4>
                    <button type="button" class="btn btn-success" onclick="requestsubmitclubuser('{{ $norequestuse->id }}')">ตกลง</button>
                    <button type="button" class="btn btn-danger" onclick="rejectsubmitclubuser('{{ $norequestuse->id }}')">ไม่อนุมัต</button><hr>
                  </div>
                @endif
              @endforeach
            @endforeach
          @endif
        @endif
      @endif
    </div>

    <div class="row">
      <div class="col-md-8"><h3>กระทู้ที่เคยสร้าง</h3></div>
    </div>

    <div class="row">
      <div class="col-md-10">
        <div class="panel-group">
          @foreach($blogprofile as $blogprofile)
          <a href="{{route('blog.blog',['blog' => $blogprofile->id])}}" target="_blank"><div class="panel panel-default">
            <div class="panel-collapse collapse in">
              <div class="panel-body">{{$blogprofile->topic}}</div>
            </div>
          </div>
          </a>
          @endforeach
        </div>
      </div>

    </div>
    @if(Auth::check())
      @if((Auth::user()->id)==($numprofile->id))
        <div class="modal fade" id="editpic" role="dialog">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">แก้ไขรูป</h4>
              </div>
              <div class="modal-body">
                <table class="table table-striped">
                  <form enctype="multipart/form-data" method="POST" action="{{ route('profile.avatar') }}">
                    <tr>
                      <th><div  align="center"> <img class="img-circle img-responsive" src="/avatar/{{ $numprofile->avatar }}" style="weight:150px; height:100px; float:left;" /> </div></th>
                      <th>
                        <input type="file" name="avatar" id="ddd">
                      </th>
                    </tr>
                    <tr>
                      <th><input type="submit" class="btn btn-success" value="ตกลง" id="ggggg"></th>
                    </tr>
                    <input type="hidden" name="_token" value="{{ Session::token() }}">
                    </form>
                </table>
              </div>
            </div>
          </div>
        </div>
      @endif
    @endif
    <div class="modal fade" id="edit" role="dialog">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">แก้ไขประวัติ</h4>
          </div>
          <div class="modal-body">
            <table class="table table-striped">
              <form method="POST" id="form-update-profile">

                <tr>
                  <th>Student ID</th>
                  <th>
                      <input type="text" class="form-control" style="width: 300px;" name="studentid_name" value="{{Request::old('studentid_name')}}" >
                      <div class="text-danger" id='error_studentid_name'>{{$errors->first('studentid_name')}}</div>
                  </th>
                </tr>
                <tr>
                  <th>Faculty</th>
                  <th>
                    <input type="text" class="form-control" style="width: 300px;" name="faculty_name" value="{{Request::old('faculty_name')}}">
                    <div class="text-danger" id='error_faculty_name'>{{$errors->first('faculty_name')}}</div>
                  </th>
                </tr>
                <tr>
                  <th>Department</th>
                  <th>
                    <input type="text" class="form-control" style="width: 300px;" name="department_name" value="{{Request::old('department_name')}}">
                    <div class="text-danger" id='error_department_name'>{{$errors->first('department_name')}}</div>
                  </th>

                </tr>
                <tr>

                  <th><input type="submit" class="btn btn-success" value="ตกลง"></th>
                  <input type="hidden" name="_token" value="{{ Session::token() }}">
                </tr>
                </form>
            </table>
          </div>
        </div>
      </div>
    </div>
    @if(Auth::check())
      @if(Auth::user()->type == 'user')
        <div class="modal fade" id="openclub" role="dialog">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">ขอเพิ่มชมรม</h4>
                </div>
                <div class="modal-body">
                  <table class="table table-striped">
                    <form method="POST" id="formrequestclub">
                      <tr>
                        <th><input type="text" id="clubname" name="avatar" class="form-control" placeholder="ชื่อชมรมที่ขอเปิด"></th>
                      </tr>
                      <tr>
                        <th><textarea rows="3" id="clubdetail" class="form-control" placeholder="รายละเอียด"></textarea></th>
                      </tr>
                      <tr>
                        <th><input type="submit" class="btn btn-success" value="ตกลง"></th>
                      </tr>
                      <input type="hidden" name="_token" value="{{ Session::token() }}">
                      </form>
                  </table>
                </div>
              </div>
            </div>
          </div>

      @endif
    @endif
    <script>
      $(document).ready(function(){

        $('#formrequestclub').submit(function(){
          var clubname = $('#clubname').val()
          var clubdetail = $('#clubdetail').val()

          $.ajax({
            url:"{{ route('postrequest.postrequest') }}",
            type:"POST",
            data:{clubname:clubname,clubdetail:clubdetail,_token:  "{{ Session::token() }}"},
            success:function(data){
              alert(data)
              $('#openclub').modal('hide');
              $('#clubname').val('')
              $('#clubdetail').val('')
            }
          });
          return false;
        })
        $("#form-update-profile").submit(function(e){
          var dds = $('#form-update-profile').serialize();

          $.post("{{ route('profile.edit') }}", dds, function(data){
            if(data.vali != undefined){
              swal("แก้ไขข้อมูลแล้ว", "", "success")

              $('#edit').modal('hide');
              $('#a').html((data.xx).studentid_name)
              $('#b').html((data.xx).faculty_name)
              $('#c').html((data.xx).department_name)
            }
            else{    //ไม่ผ่าน
              $("#error_studentid_name").html('');
              $("#error_faculty_name").html('');
              $("#error_department_name").html('');
              if (data.studentid_name !== undefined){
                  $("#error_studentid_name").html(data.studentid_name);
              }
              if (data.faculty_name !== undefined){
                  $("#error_faculty_name").html(data.faculty_name);
              }
              if (data.department_name !== undefined){
                  $("#error_department_name").html(data.department_name);
              }
            }
          });
          return false;
        });
      })
      function requestsubmit(id,requestid){
        $.ajax({
          url:"{{ route('postrequestsubmit') }}",
          type:"POST",
          data:{id:id,requestid:requestid,_token:  "{{ Session::token() }}"},
          success:function(data){
            $('#'+id).html('')
          }
        });
        return false;

      }
      function requestreject(id){
        $.ajax({
          url:"{{ route('postrequestreject') }}",
          type:"POST",
          data:{id:id,_token:  "{{ Session::token() }}"},
          success:function(data){
            $('#'+id).html('')
          }
        });
      }
      function requestsubmitclub(id){
        $.ajax({
          url:"{{ route('postsubmitrequestclub') }}",
          type:"POST",
          data:{id:id,_token:  "{{ Session::token() }}"},
          success:function(data){
            $('#club'+id).html('')
          }
        });
      }
      function requestrejectclub(id){
        $.ajax({
          url:"{{ route('postrejectrequestclub') }}",
          type:"POST",
          data:{id:id,_token:  "{{ Session::token() }}"},
          success:function(data){
            $('#club'+id).html('')
          }
        });
      }
      function requestsubmitclubuser(id){
        $.ajax({
          url:"{{ route('postsubmitfriend') }}",
          type:"POST",
          data:{id:id,_token:  "{{ Session::token() }}"},
          success:function(data){
            $('#friend'+id).html('')
          }
        });
      }
      function rejectsubmitclubuser(id){
        $.ajax({
          url:"{{ route('postrejectfriend') }}",
          type:"POST",
          data:{id:id,_token:  "{{ Session::token() }}"},
          success:function(data){
            $('#friend'+id).html('')
          }
        });
      }
    </script>


@stop
