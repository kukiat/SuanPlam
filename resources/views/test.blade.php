<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <!-- <link href="{!! asset('bootstrap/css/bootstrap.min.css') !!}" rel="stylesheet"/> -->
    <script type="text/javascript" src="{!! asset('bootstrap/js/myjs.js') !!}"></script>
    <link href="{!! asset('bootstrap/css/mycss.css') !!}" rel="stylesheet"/>
    <!-- include libraries(jQuery, bootstrap) -->
    <link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.css" rel="stylesheet">
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.js"></script>
    <script src="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.js"></script>

    <!-- include summernote css/js-->
    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.2/summernote.css" rel="stylesheet">
    <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.2/summernote.js"></script>
  </head>
  <body>
    <textarea name="name" rows="8" cols="40" id="notee"></textarea>

  </body>
  <script>
  $(document).ready(function() {
        $('#notee').summernote({
          height: 300,                 // set editor height
          minHeight: null,             // set minimum height of editor
          maxHeight: null,             // set maximum height of editor
          focus: true
        });
    });
  </script>

</html>
