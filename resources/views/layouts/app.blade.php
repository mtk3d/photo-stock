<!DOCTYPE html>
<html lang="pl">
<head>
<meta charset="utf-8">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1"> -->
    <title>{{ config('app.name', 'Laravel') }} - @yield('title')</title>

    <link rel="stylesheet" type="text/css" href="{{ url('') }}/css/style.css">
    <link rel="stylesheet" type="text/css" href="{{ url('') }}/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="{{ url('') }}/css/bootstrap-theme.min.css">
    <link rel="stylesheet" type="text/css" href="{{ url('') }}/css/font-awesome.min.css">
</head>
<body>
<div class="container-fluid header">
	<div class="container">
    <nav class="navbar navbar-default">
      <div class="navbar-header">
         <a class="navbar-brand" href="/">Photo stack</a>
      </div>
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
	      <form class="navbar-form navbar-left" role="search">
	        <div class="form-group">
	          <input type="text" class="form-control main-search-box" placeholder="Search">
	        </div>
	        <button type="submit" class="btn btn-default"><i class="fa fa-search" aria-hidden="true"></i></button>
	      </form>
		    <ul class="nav navbar-nav navbar-right">
	        @if (Route::has('login'))
	          @if (Auth::check())
	            <li class="dropdown">
	              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="badge">5</span> {{ Auth::user()->name }}<span class="caret"></span></a>
	              <ul class="dropdown-menu">
	 		            <!-- <li><a href="{{ url('photos/add') }}"><i class="fa fa-camera" aria-hidden="true"></i> Add photo</a></li> -->
	    	          <li><a href="{{ url('photos') }}"><i class="fa fa-picture-o" aria-hidden="true"></i> My photos <span class="badge">3</span></a></li>
	                <li><a href="#"><i class="fa fa-envelope" aria-hidden="true"></i> Messages <span class="badge">2</span></a></li>
	                <li role="separator" class="divider"></li>
	                <li><a href="#"><i class="fa fa-cog" aria-hidden="true"></i> Settings</a></li>
	              	<li>
	                  <a href="{{ url('/logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
	                    <i class="fa fa-sign-out" aria-hidden="true"></i> Logout
	                  </a>
										<form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
	                    {{ csrf_field() }}
	                  </form>
	                </li>
	              </ul>
	            </li>
	          @else
	              <li><a href="{{ url('/register') }}">Register</a></li>
	              <li><a href="{{ url('/login') }}">Login</a></li>
	          @endif
	        @endif
	      </ul>
	      <a class="btn btn-primary navbar-btn" href="{{ url('photos/create') }}" role="button"><i class="fa fa-plus" aria-hidden="true"></i> Add photo</a>
    	</div>
  	</nav>
	</div>
</div>
<div class="container">
	@if (Session::has('success'))
		<div class="alert alert-success alert-dismissible fade in" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button> {{ Session::get('success') }} </div>
	@endif
</div>
<!-- <div class="alert alert-info alert-dismissible fade in" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button> You are logged in! </div>  -->

    	@yield('content')  


<div class="container-fluid footer text-center">
	<p class="text-muted">
		&copy; Copyright
	</p>
</div>


<script type="text/javascript" src="{{ url('') }}/js/jquery-3.1.1.min.js"></script>
<script type="text/javascript" src="{{ url('') }}/js/bootstrap.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('dropdown-toggle').dropdown()
        $().alert('close')
    });
    $(function () {
		  $('[data-toggle="tooltip"]').tooltip()
		})
		function clearPhotoInput() {
			$("#photo-input").val('');
			$("#image-preview-container").hide();
			$("#photo-input").show();
		}
		function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#preview-image').attr('src', e.target.result);
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }
    
    $("#photo-input").change(function(){
      readURL(this);
      $("#image-preview-container").show();
			$("#photo-input").hide();
    });

</script>
</body>
</html>