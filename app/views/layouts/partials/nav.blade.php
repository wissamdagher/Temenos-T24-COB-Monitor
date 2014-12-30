<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
	<span class="sr-only">Toggle navigation</span>
	<span class="icon-bar"></span>
	<span class="icon-bar"></span>
	<span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="{{ URL::to('/') }}">COB Dashboard</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
	@if (Auth::check() && Auth::user()->verified)
	<li class="active"><a href="{{ URL::to('/') }}">Home</a></li>
	@endif
	    @if (Auth::check() && Auth::user()->verified)
	      @if (Auth::user()->is('Super Admin'))
		 <li>
		   <a href="{{ URL::to('/dual') }}">Load COB Files</a>
		 </li>
		 <li>
		   <a href="{{ URL::to('/dual_reports') }}">Load Report Files</a>
		</li>
	      @endif
	    @endif
	    @if (Auth::check() && Auth::user()->verified)
	      @if (Auth::user()->is('Super Admin'))
		  <li class="dropdown">
		    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Users <span class="caret"></span></a>
		    <ul class="dropdown-menu" role="menu">
		      <li><a href="{{ URL::to('/register/list') }}">List</a></li>
		      <li class="divider"></li>
		      <li><a href="{{ URL::to('/register') }}">Register</a></li>
		    </ul>
		  </li>
	      @endif
	    @endif
	    <li>
	      @if (Auth::check() && Auth::user()->verified)
		 <a href="{{ URL::to('/cobs') }}">Compare COBS</a>
	      @endif
	    </li>
	    <li>
	      @if (Auth::check() && Auth::user()->verified)
		 <a href="{{ URL::to('/multicobs') }}">Multi COBS</a>
	      @endif
	    </li>
	    <li>
	      @if (Auth::check() && Auth::user()->verified)
		<a href="{{ URL::to('/dashboard') }}">Last COB</a>
	      @endif
	    </li>
	    <li>
	      @if (Auth::check() && Auth::user()->verified)
		<a href="{{ URL::to('/calendar') }}">Calendar</a>
	      @endif
	    </li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
	@if ( Auth::guest() )
	   <li>
	      <a href="{{ URL::to('login')}}">
		<i class="icon-user"></i> Login </a></li>
	    @else
	    <li><p class="navbar-text">Welcome, </p></li>
	    <li class="dropdown">
	     <a href="#" class="dropdown-toggle" data-toggle="dropdown">{{ Auth::user()->username }} <span class="caret"></span></a>
	      <ul class="dropdown-menu" role="menu">
		<li><a href="/account/change-password"><span class="glyphicon glyphicon-cog"></span> Change Password </a></li>
		<li class="divider"></li>
		<li><a href="/logout"><span class="glyphicon glyphicon-log-out"></span> Logout </a></li
	      </ul>
	    </li>
	   @endif
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
