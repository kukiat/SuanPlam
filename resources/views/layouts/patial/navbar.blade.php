<nav class="navbar navbar-default navbar-static-top" style="background-color:#ff7300;">
  <div class="navbar-header" >
    <a href="{{ route('home') }}"class="navbar-brand">Suanplam</a>
  </div>
  <div id="talang" class="navbar-collapse">
    <ul class="nav navbar-nav">
      <li><a href="{{ route('feed.index') }}">Feed</a></li>
      <li><a href="{{ route('classroom.classroom') }}">Classroom</a></li>
      <li><a href="{{ route('mainclub') }}">club</a></li>

    </ul>
    <div class="nav navbar navbar-right">
      @if (Auth::check())
      <ul class="nav navbar-nav">
        <li><img class="img-circle img-responsive" src="/avatar/{{ Auth::user()->avatar }}" style="weight:30px; height:30px;padding-botton:20px;"/></li>
        <!-- <ul class="nav navbar-nav"> -->
          <!-- อาจจะทำ profile ส่วนตัวเปนอีกแบบ -->
          <!-- <li><a href="{{route('profile.profile',['num'=>Auth::user()->id])}}")>{{ Auth::user()->getNameOrUsername() }}</a></li>
          <li><a href="#">update</a></li></li>
          <li><a href="{{ route('member.signout') }}">sign out</a></li> -->
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">{{ Auth::user()->username }}<span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
              <li><a href="{{route('profile.profile',['num'=>Auth::user()->id])}}">Profile</a></li>
              <li><a href="#">Update</a></li>
              <li><a href="{{ route('member.signout') }}">Sign out</a></li>
            </ul>
          </li>
        <!-- </ul> -->
        </ul>
      @else
        <ul class="nav navbar-nav">
          <a class="btn btn-success" href="{{ route('member.signin') }}" role="button">Sign In</a>
          <a class="btn btn-success" href="{{ route('member.signup') }}" role="button">Sign Up</a>
        </ul>
      @endif
    </div>
  </div>
</nav>
<script type="text/javascript">
  $(document).ready(function(){
    $(".dropdown").hover(
        function() {
            $('.dropdown-menu', this).not('.in .dropdown-menu').stop(true,true).slideDown("400");
            $(this).toggleClass('open');
        },
        function() {
            $('.dropdown-menu', this).not('.in .dropdown-menu').stop(true,true).slideUp("400");
            $(this).toggleClass('open');
        }
    );
  });
</script>

<!-- <div id="custom-bootstrap-menu" class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header"><a class="navbar-brand" href="#">SUANPLAM</a>
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-menubuilder"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse navbar-menubuilder">
            <ul class="nav navbar-nav navbar-left">
                <li><a href="adad">FEED</a>
                </li>
                <li class="active"><a href="as">CLASSROOM</a>
                </li>
                <li><a href="sd">CLUB</a>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
              <li><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
              <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
            </ul>
        </div>
    </div>
</div> -->
