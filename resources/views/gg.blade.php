<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />

    <link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.css" rel="stylesheet">
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.js"></script>
    <script src="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.js"></script>

    <!-- include summernote css/js-->
    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.2/summernote.css" rel="stylesheet">
    <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.2/summernote.js"></script>
    <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> -->
    <script src="{!! asset('bootstrap/sweetalert/dist/sweetalert.min.js') !!}"></script>
    <link rel="stylesheet" type="text/css" href="{!! asset('bootstrap/sweetalert/dist/sweetalert.css') !!}">
    <link href="{!! asset('bootstrap/css/mycss.css') !!}" rel="stylesheet"/>
    <script type="text/javascript" src="{!! asset('bootstrap/js/myjs.js') !!}"></script>
  </head>
  <body>
    <div class="row">
    	<div class="span8">
    		<!-- Post Title -->
    		<div class="row">
    			<div class="span8">
    				<h4>Ajax Image Upload and Preview With Laravel</h4>
    			</div>
    		</div>
    		<!-- Post Footer -->
    		<div class="row">
    			<div class="span3">
    				<div id="validation-errors"></div>
    				<form class="form-horizontal" id="upload" enctype="multipart/form-data" method="post" action="{{ url('upload/image') }}" autocomplete="off">
    					<input type="hidden" name="_token" value="{{ csrf_token() }}" />
    					<input type="file" name="image" id="image" />
    				</form>

    			</div>
    			<div class="span5">
    				<div id="output" style="display:none">
    				</div>
    			</div>
    		</div>
    	</div>
    </div>
    <script>
  $(document).ready(function() {
      var options = {
        beforeSubmit:showRequest,
        success:showResponse,
        dataType:'json'
      };
      $('body').delegate('#image','change', function(){
        $('#upload').ajaxForm(options).submit();
      });
    });
    function showRequest(formData, jqForm, options) {
      $("#validation-errors").hide().empty();
      $("#output").css('display','none');
      return true;
    }
    function showResponse(response, statusText, xhr, $form){
      if(response.success == false){
        var arr = response.errors;
        $.each(arr, function(index, value){
          if (value.length != 0){
            $("#validation-errors").append('<div class="alert alert-error"><strong>'+ value +'</strong><div>');
          }
        });
        $("#validation-errors").show();
      }else{
         $("#output").html("<img src='"+response.file+"' />");
         $("#output").css('display','block');
      }
    }
    </script>
  </body>


</html>
