<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <!-- <link href="{!! asset('bootstrap/css/bootstrap.min.css') !!}" rel="stylesheet"/> -->

    <!-- include libraries(jQuery, bootstrap) -->
    <link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.css" rel="stylesheet">
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.js"></script>
    <script src="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.js"></script>

    <!-- include summernote css/js-->
    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.2/summernote.css" rel="stylesheet">
    <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.2/summernote.js"></script>
    <script type="text/javascript" src="{!! asset('bootstrap/js/myjs.js') !!}"></script>
    <link href="{!! asset('bootstrap/css/mycss.css') !!}" rel="stylesheet"/>
  </head>
  <body>
    <form id="testform" method="post">
      <input type="text" id="qq" ><br>
      <input type="text" id="qqq" ><br>
      <p>P1</p>
      <p>P2</p>
      <p>P3</p>
      <button type="submit" name="button">dwwd</button>
      <input type="hidden" name="_token" value="{{ Session::token() }}">
    </form>
    <div id="r">

    </div>
    <script>
    $(document).ready(function(){
      $('#testform').on('submit',function(){
        $('')

        $.ajax({
          url:"{{ route('dposttest') }}",
          type:"POST",
           data:{qq:qq,qqq:qqq,_token: "{{ Session::token() }}"},
          success:function(data){
            $('#r').html(data.qq+data.qqq)
          }

        });
        return false;
      });
    })
    </script>

  </body>



</html>
