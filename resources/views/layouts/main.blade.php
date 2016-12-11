<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Suanpalm</title>


    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.js"></script>
    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.2/summernote.css" rel="stylesheet">
    <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.2/summernote.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="{!! asset('select2/dist/js/select2.min.js') !!}"></script>
    <link rel="stylesheet" href="{!! asset('select2/dist/css/select2.min.css') !!}">
    <script src="{!! asset('sweetalert/dist/sweetalert.min.js') !!}"></script>
    <link rel="stylesheet" type="text/css" href="{!! asset('sweetalert/dist/sweetalert.css') !!}">
    <link href="{!! asset('css/mycss.css') !!}" rel="stylesheet"/>
    <script type="text/javascript" src="{!! asset('js/myjs.js') !!}"></script>



  </head>
<body>

    @include('layouts.patial.navbar')
    <div class="container main">
      @include('layouts.patial.alert')

      @yield('content')
    </div>

  </body>
</html>
