@extends('layouts.main')
@section('content')

	<div class="container main">
		<div class="row">
			<div class="col s12 m12 l9">
				<div class=" z-depth-3">
					<div class="profile-head">
						<h5 class="center-align" style="padding-top: 12px;color:white">ข้อมูลส่วนตัว</h5>
					</div>
          @foreach($numprofile as $numprofile)
					<div class="profile-panel">
						<div class="profile-profile">
							<img src="/avatar/{{ $numprofile->avatar  }}" data-target="edit-picture" width="150" height="150" style="border-radius: 50%;margin-left: 10px;">
								<div class="profile-data">

									<div class="input-field col s12 m12 l12 ">
							          	<input placeholder="Placeholder" id="Username" type="text" class="valid" value="{{$numprofile->username}}">
							          	<label for="username">{{$numprofile->username}}</label>
							        </div>
							        <div class="input-field col s12 m12 l12 ">
							          	<input placeholder="" id="first_name" type="text" class="valid" value="{{$numprofile->email}}">
							          	<label for="first_name">{{$numprofile->email}}</label>
							        </div>
						        </div>
									@endforeach
				        </div>
				        <div class="row">
    						<div class="col s12">
      							<ul class="tabs">
        							<li class="tab col s3"><a href="#post-owner">ข่าวสารที่เคยตั้ง</a></li>

      							</ul>
    						</div>
    						<div id="post-owner" class="col s12">
    							<div class="profile-posts-owner">
										@foreach($blogprofile as $blogprofile)
									<!-- โพสที่เคยสร้าง -->
				        			<div class="post moveIn" style="margin-left: 20px">
		    							<div class="post-profile">
		    								<img src="/avatar/{{$blogprofile->member_userr->avatar}}">
		    							</div>
		    							<div class="topic">
			    							<a href="#modal-post">{{$blogprofile->topic}}</a>
			    							<div class="detail">{!! str_limit($blogprofile->body,15) !!}</div>
				    						<div class="post-user"><a href="" class="black-text">คนสร้าง</a><span style="font-size: 0.8rem;">&nbsp;สร้างเมื่อ 15 ตุลาคม 2556</span></div>
			    						</div>
			    					</div>
										@endforeach
	    						</div>
    						</div>
								<!-- คอมเม้น -->

  						</div>
					</div>
				</div>
			</div>
@if(Auth::check())
	@if(Auth::user()->type == 'admin')
						<div class="col s12 m12 l3 center-align" style="padding-top: 10px;">

								<div class="col s12 m12 l12 ">
									<h5>ชมรมรออนุมัติ</h5>
									<hr>
					@if(Auth::user()->id == $num)
									<!-- ขอเปิดชมรมชมรม -->
								@foreach($clubrequest as $clubreques)
									<div class="card z-depth-3 card-profile">
				            			<div class="card-content">
							              	<span class="card-title">{{ $clubreques->club_name }}</span>
							              	<p>{{ $clubreques->detail }}</p>
							              	<p>{{ $clubreques->members->username }}</p>
					              			<a href="#" class="btn" style="width: 100%;margin-bottom: 10px;margin-top: 10px" onclick="requestsubmit('{{ $clubreques->id }}','{{ $clubreques->member_request_id }}')">อนุมัติ</a>
					              			<a href="#" onclick="requestreject('{{ $clubreques->id }}')">ไม่อนุมัติ</a>
							            </div>
							        </div>
									@endforeach
								</div>

								<div class="col s12 m12 l12" style="margin-top: 20px;">
									<h5>คนร้องขอเข้าชมรม</h5>
									<hr>
									<!-- คนขอเข้าชมรม -->
									@foreach($norequest as $noreques)
									<div class="card z-depth-3 card-profile">
				            			<div class="card-content">
							              	<span class="card-title">{{ $noreques->members->username }}</span>
							              	<p>{{ $noreques->clubs->club_name }}</p>
					              			<a href="#" class="btn" style="width: 100%;margin-bottom: 10px;margin-top: 10px" onclick="requestsubmitclub('{{ $noreques->id }}')">อนุมัติ</a>
					              			<a href="#" onclick="requestrejectclub('{{ $noreques->id }}')">ไม่อนุมัติ</a>
							            </div>
							      </div>
										@endforeach
									</div>
					@endif
	@else <!--หลังจากนี้คือคนทั่วไป -->


			@if(Auth::user()->id == $num)
							<div class="col s12 m12 l12" style="margin-top: 20px;">
									<h5>คนร้องขอเข้าชมรม</h5>
									<hr>

									<!-- คนขอเข้าชมรม -->
									@foreach($yesrequestuser as $yesrequestuse)
			              @foreach($norequestuser as $norequestuse)
			                @if(($yesrequestuse->club_yesrequestclub_id) == ($norequestuse->club_norequestclub_id))
											<div class="card z-depth-3 card-profile" id="friend{{ $norequestuse->id }}">
				            			<div class="card-content">
							              	<span class="card-title">{{ $norequestuse->clubs->club_name }}</span>
							              	<p>{{ $norequestuse->members->username }}</p>
					              			<a href="#" class="btn" style="width: 100%;margin-bottom: 10px;margin-top: 10px" onclick="requestsubmitclubuser('{{ $norequestuse->id }}')">อนุมัติ</a>
					              			<a href="#" onclick="rejectsubmitclubuser('{{ $norequestuse->id }}')">ไม่อนุมัติ</a>
							            </div>
							        </div>
											@endif
			              @endforeach
			            @endforeach

								</div>
			@endif
						</div>
	@endif
@endif

		</div>
	</div>
	<div id="edit-picture" class="modal">
		<div class="modal-content">
				<h4>แก้ไขรูปภาพชมรม</h4>
				<div class="input-field file-field col s12 ">
					<form enctype="multipart/form-data" method="POST" action="{{ route('profile.avatar') }}">
							<div class="btn">
								<span>File</span>

								<input type="file" name="avatar">
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
