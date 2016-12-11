<div class="navbar-fixed">
	<nav>
		<div class="nav-wrapper container">
			<a href="{{ route('home') }}" class="brand">SuanPalm</a>
			<ul class="right hide-on-small-only">
				<li><a href="{{ route('feed.index') }}">News</a></li>
				<li><a href="{{ route('mainclub') }}">Clubs</a></li>
				<li class="active"><a href="{{ route('classroom.classroom') }}">Classroom</a></li>
				@if (Auth::check())
				<li><a href="{{route('profile.profile',['num'=>Auth::user()->id])}}" class="profile">
					<img src="/avatar/{{ Auth::user()->avatar }}" width="30" height="30">
					<span class="name">{{ Auth::user()->username }}</span>
				</a></li>
				<li><a href="{{ route('member.signout') }}"><i class="fa fa-sign-out fa-lg"></i>Logout</a></li>
			</ul>
			@else
			<li><a href="{{ route('member.signin') }}"><i class="fa fa-user fa-lg"></i> Sign in</a></li>
			@endif
			<ul class="right hide-on-med-and-up">
				<li><a class="sideNav" data-activates="mobile-demo"><i class="fa fa-bars fa-lg"></i></a></li>
			</ul>
	    </div>
 	</nav>
	</div>
<ul class="side-nav" id="mobile-demo">
	@if (Auth::check())
	<li><a href="{{route('profile.profile',['num'=>Auth::user()->id])}}" style="display: flex;">
		<img src="/avatar/{{ Auth::user()->avatar }}" width="30" height="30" style="margin-top: 7px;">
		<span class="name">{{ Auth::user()->username }}</span>
	</a></li>
	@else
	<li><a href="{{ route('member.signin') }}"><i class="fa fa-user fa-lg"></i>Sign in</a></li>
		@endif
    <li><a href="{{ route('feed.index') }}">News</a></li>
	<li><a href="{{ route('mainclub') }}">Clubs</a></li>
	<li class="active"><a href="{{ route('classroom.classroom') }}">Classroom</a></li>
		@if (Auth::check())
	<li><a href="{{ route('member.signout') }}"><i class="fa fa-sign-out fa-lg"></i>Logout</a></li>
	@endif
</ul>
