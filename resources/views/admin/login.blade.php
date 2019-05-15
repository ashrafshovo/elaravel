<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
	
	<!-- start: Meta -->
	<meta charset="utf-8">
	<title>Admin || Login</title>
	<meta name="description" content="Metro Admin Template.">
	<meta name="author" content="Łukasz Holeczek">
	<meta name="keyword" content="Metro, Metro UI, Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">


	<meta name="csrf-token" content="{{ csrf_token() }}">
	
	<!-- end: Meta -->
	
	<!-- start: Mobile Specific -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- end: Mobile Specific -->
	
	<!-- start: CSS -->
	<link id="bootstrap-style" href="{{ asset('back/css/bootstrap.min.css') }}" rel="stylesheet">
	<link href="{{ asset('back/css/bootstrap-responsive.min.css') }}" rel="stylesheet">
	<link id="base-style" href="{{ asset('back/css/style.css') }}" rel="stylesheet">
	<link id="base-style-responsive" href="css/style-responsive.css" rel="stylesheet">
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&amp;subset=latin,cyrillic-ext,latin-ext' rel='stylesheet' type='text/css'>
	<!-- end: CSS -->
	

	<!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
	  	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<link id="ie-style" href="css/ie.css" rel="stylesheet">
	<![endif]-->
	
	<!--[if IE 9]>
		<link id="ie9style" href="css/ie9.css" rel="stylesheet">
	<![endif]-->

	<!-- start: Favicon -->
	<link rel="shortcut icon" href="{{ asset('back/img/favicon.ico') }}">
	<!-- end: Favicon -->
	
	<style type="text/css">
	body { background: url(back/img/bg-login.jpg) !important; }
</style>



</head>

<body>
	<div class="container-fluid-full">
		<div class="row-fluid">

			<div class="row-fluid">
				<div class="login-box">
					<div class="icons">
						<a href="{{ route('index') }}"><i class="halflings-icon home"></i></a>
						{{-- <a href="#"><i class="halflings-icon cog"></i></a> --}}
					</div>
						<?php 
							$message = Session::get('message');
							if ($message) {
								echo '<div class="box-content">
										<div class="alert alert-error">
											<button type="button" class="close" data-dismiss="alert">×</button><strong>'.$message.'</strong>
										</div>
									</div>';
							}
							Session::put('message', null);
						?>

							@if ($errors->any())
							    @foreach ($errors->all() as $error)
        							<div class="alert alert-error">
            							<button type="button" aria-hidden="true" class="close"
            								onclick="this.parentElement.style.display='none'">×</button>
            							<strong>{{ $error }}</strong>
        							</div>
    							@endforeach
							@endif

					<h2>Login to your account</h2>					

					<form class="form-horizontal" action="{{ route('admin_dashboard') }}" method="post">
						@csrf
						<fieldset>
							
							<div class="input-prepend" title="Username">
								<span class="add-on"><i class="halflings-icon envelope"></i></span>
								<input class="input-large span10" name="admin_email" id="username" type="email" placeholder="type email"/>
							</div>
							<div class="clearfix"></div>

							<div class="input-prepend" title="Password">
								<span class="add-on"><i class="halflings-icon lock"></i></span>
								<input class="input-large span10" name="admin_password" id="password" type="password" placeholder="type password"/>
							</div>
							<div class="clearfix"></div>
							
							<label class="remember" for="remember"><input type="checkbox" id="remember" />Remember me</label>

							<div class="button-login">	
								<button type="submit" class="btn btn-primary">Login</button>
							</div>
							<div class="clearfix"></div>
						</form>
						<hr>
						<h3>Forgot Password?</h3>
						<p>
							No problem, <a href="#">click here</a> to get a new password.
						</p>	
					</div><!--/span-->
				</div><!--/row-->


			</div><!--/.fluid-container-->

		</div><!--/fluid-row-->

		<!-- start: JavaScript-->

		<script src="{{ asset('back/js/jquery-1.9.1.min.js') }}"></script>
		<script src="{{ asset('back/js/jquery-migrate-1.0.0.min.js') }}"></script>

		<script src="{{ asset('back/js/jquery-ui-1.10.0.custom.min.js') }}"></script>

		<script src="{{ asset('back/js/jquery.ui.touch-punch.js') }}"></script>

		<script src="{{ asset('back/js/modernizr.js') }}"></script>

		<script src="{{ asset('back/js/bootstrap.min.js') }}"></script>

		<script src="{{ asset('back/js/jquery.cookie.js') }}"></script>

		<script src="{{ asset('back/js/fullcalendar.min.js') }}"></script>

		<script src="{{ asset('back/js/jquery.dataTables.min.js') }}"></script>

		<script src="{{ asset('back/js/excanvas.js') }}"></script>
		<script src="{{ asset('back/js/jquery.flot.js') }}"></script>
		<script src="{{ asset('back/js/jquery.flot.pie.js') }}"></script>
		<script src="{{ asset('back/js/jquery.flot.stack.js') }}"></script>
		<script src="{{ asset('back/js/jquery.flot.resize.min.js') }}"></script>

		<script src="{{ asset('back/js/jquery.chosen.min.js') }}"></script>

		<script src="{{ asset('back/js/jquery.uniform.min.js') }}"></script>
		
		<script src="{{ asset('back/js/jquery.cleditor.min.js') }}"></script>

		<script src="{{ asset('back/js/jquery.noty.js') }}"></script>

		<script src="{{ asset('back/js/jquery.elfinder.min.js') }}"></script>

		<script src="{{ asset('back/js/jquery.raty.min.js') }}"></script>

		<script src="{{ asset('back/js/jquery.iphone.toggle.js') }}"></script>

		<script src="{{ asset('back/js/jquery.uploadify-3.1.min.js') }}"></script>

		<script src="{{ asset('back/js/jquery.gritter.min.js') }}"></script>

		<script src="{{ asset('back/js/jquery.imagesloaded.js') }}"></script>

		<script src="{{ asset('back/js/jquery.masonry.min.js') }}"></script>

		<script src="{{ asset('back/js/jquery.knob.modified.js') }}"></script>

		<script src="{{ asset('back/js/jquery.sparkline.min.js') }}"></script>

		<script src="{{ asset('back/js/counter.js') }}"></script>

		<script src="{{ asset('back/js/retina.js') }}"></script>

		<script src="{{ asset('back/js/custom.js') }}"></script>
		<!-- end: JavaScript-->

	</body>

	<!-- Mirrored from bootstrapmaster.com/live/metro/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 08 Jan 2018 16:57:01 GMT -->
	</html>
