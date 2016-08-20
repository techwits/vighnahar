<!DOCTYPE html>
<html lang="en">



<?php
	include_once('assets/inc/db_connect.php');
	include_once('assets/inc/common-function.php');
	include_once('assets/inc/functions.php');


	if (isset($_COOKIE[SITECOOKIE]))
	{
		setcookie(SITECOOKIE, "", time()-3600, "/");
	}

	$Lockuser_emailid="";
	if (isset($_COOKIE[LOCKCOOKIE]))
	{
		echo("1 Comes in login page");
		die();
		include_once 'assets/inc/logout.php';
		parse_str($_COOKIE[LOCKCOOKIE]);
		//echo("Lock user name :- $lock </br>");
		$Lockuser_emailid=$lock;
	}
	else
	{
		echo("2 Comes in login page");
		die();
		header("Location: login.php");
	}
?>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Limitless - Responsive Web Application Kit by Eugene Kopyov</title>

	<!-- Global stylesheets -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
	<link href="assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
	<link href="assets/css/bootstrap.css" rel="stylesheet" type="text/css">
	<link href="assets/css/core.css" rel="stylesheet" type="text/css">
	<link href="assets/css/components.css" rel="stylesheet" type="text/css">
	<link href="assets/css/colors.css" rel="stylesheet" type="text/css">
	<!-- /global stylesheets -->

	<!-- Core JS files -->
	<script type="text/javascript" src="assets/js/plugins/loaders/pace.min.js"></script>
	<script type="text/javascript" src="assets/js/core/libraries/jquery.min.js"></script>
	<script type="text/javascript" src="assets/js/core/libraries/bootstrap.min.js"></script>
	<script type="text/javascript" src="assets/js/plugins/loaders/blockui.min.js"></script>
	<!-- /core JS files -->

	<!-- Theme JS files -->
	<script type="text/javascript" src="assets/js/plugins/forms/styling/uniform.min.js"></script>

	<script type="text/javascript" src="assets/js/core/app.js"></script>
	<script type="text/javascript" src="assets/js/pages/login.js"></script>

	<script type="text/JavaScript" src="assets/js/search/search.js"></script>
	<script type="text/JavaScript" src="assets/js/sha512.js"></script>
	<script type="text/JavaScript" src="assets/js/forms.js"></script>

	<!-- /theme JS files -->

</head>



<body>

	<!-- Main navbar -->
	<div class="navbar navbar-inverse">
		<div class="navbar-header">
			<a class="navbar-brand" href="index.html"><img src="assets/images/logo_light.png" alt=""></a>

			<ul class="nav navbar-nav pull-right visible-xs-block">
				<li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
			</ul>
		</div>

		<div class="navbar-collapse collapse" id="navbar-mobile">
			<ul class="nav navbar-nav navbar-right">
				<li>
					<a href="#">
						<i class="icon-display4"></i> <span class="visible-xs-inline-block position-right"> Go to website</span>
					</a>
				</li>

				<li>
					<a href="#">
						<i class="icon-user-tie"></i> <span class="visible-xs-inline-block position-right"> Contact admin</span>
					</a>
				</li>

				<li class="dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown">
						<i class="icon-cog3"></i>
						<span class="visible-xs-inline-block position-right"> Options</span>
					</a>
				</li>
			</ul>
		</div>
	</div>
	<!-- /main navbar -->


	<!-- Page container -->
	<div class="page-container login-container">

		<!-- Page content -->
		<div class="page-content">

			<!-- Main content -->
			<div class="content-wrapper">

				<!-- Content area -->
				<div class="content">

					<!-- Unlock user -->
					<form action="inc/process_login.php" method="post" name="logincheck_form" id="logincheck_form" class="smart-form">
						<div class="panel login-form">
							<div class="thumb thumb-rounded">
								<img src="assets/images/placeholder.jpg" alt="">
								<div class="caption-overflow">
									<span>
										<a href="#" class="btn border-white text-white btn-flat btn-icon btn-rounded btn-xs"><i class="icon-collaboration"></i></a>
										<a href="#" class="btn border-white text-white btn-flat btn-icon btn-rounded btn-xs ml-5"><i class="icon-question7"></i></a>
									</span>
								</div>
							</div>

							<div class="panel-body">
								<h6 class="content-group text-center text-semibold no-margin-top"><?php echo $Lockuser_emailid; ?><small class="display-block">Unlock your account</small></h6>

								<div class="form-group has-feedback">
									<input type="hidden" class="form-control" name="userid" id="userid" value="<?php echo $Lockuser_emailid; ?>">
									<input type="password" class="form-control" name="userpassword" id="userpassword" placeholder="Enter password" autofocus>
									<div class="form-control-feedback">
										<i class="icon-user-lock text-muted"></i>
									</div>
								</div>

								<div class="form-group login-options">
									<div class="row">
										<div class="col-sm-6">
											<label class="checkbox-inline">
												<input type="checkbox" name="autologin" id="autologin" class="styled" checked>
												Remember
											</label>
										</div>

										<div class="col-sm-6 text-right">
											<a href="login_password_recover.html">Forgot password?</a>
										</div>
									</div>
								</div>

								<button type="button" value="Login" class="btn btn-primary" onclick="formhash(this.form, this.form.password);">
									Sign in
								</button>
							</div>
						</div>
					</form>
					<!-- /unlock user -->


					<!-- Footer -->
					<div class="footer text-muted">
						&copy; 2015. <a href="#">Limitless Web App Kit</a> by <a href="http://themeforest.net/user/Kopyov" target="_blank">Eugene Kopyov</a>
					</div>
					<!-- /footer -->

				</div>
				<!-- /content area -->

			</div>
			<!-- /main content -->

		</div>
		<!-- /page content -->

	</div>
	<!-- /page container -->

</body>
</html>
